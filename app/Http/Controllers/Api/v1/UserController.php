<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Repositories\v1\UserRepository;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

/**
 * @group User
 *
 */
class UserController extends Controller
{

    public function __construct(public UserRepository $userRepository) {}

    /**
     * User Get all
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function index(Request $request)
    {
        return $this->userRepository->index($request);
    }

    /**
     * User adminIndex get All
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function adminIndex(Request $request)
    {
        Gate::authorize('users.view');

        return $this->userRepository->adminIndex($request);
    }

    /**
     * User view
     *
     * @queryParam id required
     *
     * @param Request $request
     * @param int     $id
     * @return JsonResponse
     * @response {
    {{response}}
     * }
     */

    public function show(Request $request, User $user): JsonResponse
    {
        return $this->userRepository->show($request, $user);
    }

    /**
     * User create
     *
     * @bodyParam name string
     * @bodyParam email_verified_at date
     * @bodyParam password string
     * @bodyParam email string
     * @bodyParam login string
     * @bodyParam phone string
     * @bodyParam status integer
     * @bodyParam remember_token string
     * @bodyParam currency_id integer
     * @bodyParam monthly_budget integer
     * @bodyParam lang string

     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */

    public function store(StoreUserRequest $request): JsonResponse
    {
        Gate::authorize('users.create');

        return $this->userRepository->store($request);
    }

    /**
     * User update
     *
     * @queryParam user required
     *
     * @bodyParam name string
     * @bodyParam email_verified_at date
     * @bodyParam password string
     * @bodyParam email string
     * @bodyParam login string
     * @bodyParam phone string
     * @bodyParam status integer
     * @bodyParam remember_token string
     * @bodyParam currency_id integer
     * @bodyParam monthly_budget integer
     * @bodyParam lang string

     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        Gate::authorize('users.update');

        return $this->userRepository->update($request, $user);
    }

    /**
     * User delete
     *
     * @queryParam user required
     *
     * @param User $user
     * @return JsonResponse
     */

    public function destroy(User $user): JsonResponse
    {
        Gate::authorize('users.delete');

        return  $this->userRepository->destroy($user);
    }

    /**
     * Assign role to user
     *
     * @bodyParam roles array required Array of role names
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function assignRole(Request $request, User $user): JsonResponse
    {
        \Illuminate\Support\Facades\Gate::authorize('roles.assign');

        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user->syncRoles($request->roles);
        $user->load('roles', 'permissions');

        return okResponse([
            'message' => 'Roles assigned successfully',
            'user' => $user
        ]);
    }

    /**
     * Sync permissions for user
     *
     * @bodyParam permissions array required Array of permission names
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function syncPermissions(Request $request, User $user): JsonResponse
    {
        \Illuminate\Support\Facades\Gate::authorize('permissions.assign');

        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $user->syncPermissions($request->permissions);
        $user->load('roles', 'permissions');

        return okResponse([
            'message' => 'Permissions synced successfully',
            'user' => $user
        ]);
    }
}
