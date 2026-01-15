<?php

namespace App\Http\Repositories\v1;


use App\DTO\SocialLoginDto;
use App\Helpers\Roles;
use App\Jobs\ProfilePhotoSyncJob;
use App\Models\User;
use App\Models\UserLoginProviders;
use App\Models\UserToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Helpers\Traits\QueryBuilderTrait;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class UserRepository
{
    use QueryBuilderTrait;
    /**
     * @var User $ modelClass
     */
    protected mixed $modelClass = User::class;

    public function index(Request $request): JsonResponse
    {
        $query = $this->defaultQuery($request);
        $this->defaultAllowFilter($query, $request);
        return $this->withPagination($query, $request);
    }

    public function adminIndex(Request $request): JsonResponse
    {
        $query = $this->defaultQuery($request);
        $query->with('roles', 'permissions');
        $this->defaultAllowFilter($query, $request);
        return $this->withPagination($query, $request);
    }

    public function show(Request $request, User $user): JsonResponse
    {
        $this->allowIncludeAndAppend($request, $user);
        return okResponse($user);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->except('role');
        $model = User::query()->create($data);

        // Assign role if provided
        if ($request->has('role')) {
            $model->syncRoles([$request->role]);
        }

        $this->allowIncludeAndAppend($request, $model);
        $model->load('roles', 'permissions');
        return okResponse($model);
    }

    public function update(Request $request, User $user): JsonResponse
    {
        $data = $request->except('role');
        $user->update($data);

        // Update role if provided
        if ($request->has('role')) {
            $user->syncRoles([$request->role]);
        }

        $this->allowIncludeAndAppend($request, $user);
        $user->load('roles', 'permissions');
        return okResponse($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return okResponse($user);
    }
    public function socialLogin(SocialLoginDto $socialLoginDto)
    {
        $userProviders = UserLoginProviders::where('provider', $socialLoginDto->provider)
            ->where('provider_id', $socialLoginDto->provider_id)
            ->first();
        if (!$userProviders) {
            $userProviders = UserLoginProviders::create([
                'provider' => $socialLoginDto->provider,
                'phone' => $socialLoginDto->phone,
                'email' => $socialLoginDto->email,
                'provider_id' => $socialLoginDto->provider_id,
                'photo' => $socialLoginDto->avatar,
                'full_name' => $socialLoginDto->full_name,
            ]);
            $user = User::create([
                'name' => $socialLoginDto->full_name,
                'email' => $socialLoginDto->email,
                'login' => Str::uuid(),
                'password' => bcrypt(Str::random(8)),
            ]);

            $user->userRole()->create([
                'name' => 'Student',
                'role' => Roles::ROLE_STUDENT,
            ]);

            $userProviders->update([
                'user_id' => $user->id,
            ]);
        } elseif ($userProviders->user) {
            $user = User::find($userProviders->user_id);
        } else {
            return null;
        }


        return $user;
    }

    public function getMe(Request $request): JsonResponse
    {
        $user = $request->user();
        $this->allowIncludeAndAppend($request, $user);
        $user->load('roles');
        $userArray = $user->toArray();
        $userArray['permissions'] = $user->getAllPermissions()->pluck('name');
        $data = [
            'user' => $userArray,
            'token' => $request->bearerToken(),
        ];
        return okResponse($data);
    }
    public function updateMe(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->update($request->only(['password', 'photo']));

        $this->allowIncludeAndAppend($request, $user);

        return okResponse($user);
    }
}
