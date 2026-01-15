<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserTestSession\StoreUserTestSessionRequest;
use App\Http\Requests\UserTestSession\UpdateUserTestSessionRequest;
use App\Http\Repositories\v1\UserTestSessionRepository;
use Illuminate\Http\JsonResponse;
use App\Models\UserTestSession;
use Illuminate\Support\Facades\Gate;
/**
 * @group UserTestSession
 *
 */
class UserTestSessionController extends Controller
{

    public function __construct(public UserTestSessionRepository $userTestSessionRepository)
    {
    }

    /**
    * UserTestSession Get all
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function index(Request $request)
    {
        return $this->userTestSessionRepository->index($request);
    }

    /**
    * UserTestSession adminIndex get All
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function adminIndex(Request $request)
    {
        Gate::authorize('test-sessions.view');

        return $this->userTestSessionRepository->adminIndex($request);
    }

    /**
    * UserTestSession view
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

    public function show(Request $request, UserTestSession $userTestSession): JsonResponse
    {
        return $this->userTestSessionRepository->show($request, $userTestSession);
    }

    /**
    * UserTestSession create
    *
         * @bodyParam user_id integer
     * @bodyParam test_id integer
     * @bodyParam started_at date
     * @bodyParam finished_at date
     * @bodyParam score integer
     * @bodyParam correct_answers integer
     * @bodyParam wrong_answers integer
     * @bodyParam status integer

    *
    * @param StoreUserTestSessionRequest $request
    * @return JsonResponse
    */

    public function store(StoreUserTestSessionRequest $request): JsonResponse
    {
        Gate::authorize('test-sessions.create');

        return $this->userTestSessionRepository->store($request);
    }

    /**
    * UserTestSession update
    *
    * @queryParam userTestSession required
    *
         * @bodyParam user_id integer
     * @bodyParam test_id integer
     * @bodyParam started_at date
     * @bodyParam finished_at date
     * @bodyParam score integer
     * @bodyParam correct_answers integer
     * @bodyParam wrong_answers integer
     * @bodyParam status integer

    *
    * @param UpdateUserTestSessionRequest $request
    * @param UserTestSession $userTestSession
    * @return JsonResponse
    */

    public function update(UpdateUserTestSessionRequest $request, UserTestSession $userTestSession): JsonResponse
    {
        Gate::authorize('test-sessions.update');

         return $this->userTestSessionRepository->update($request, $userTestSession);
    }

    /**
     * UserTestSession delete
     *
     * @queryParam userTestSession required
     *
     * @param UserTestSession $userTestSession
     * @return JsonResponse
     */

    public function destroy(UserTestSession $userTestSession): JsonResponse
    {
        Gate::authorize('test-sessions.delete');

        return  $this->userTestSessionRepository->destroy($userTestSession);
    }
}
