<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserTestAnswer\StoreUserTestAnswerRequest;
use App\Http\Requests\UserTestAnswer\UpdateUserTestAnswerRequest;
use App\Http\Repositories\v1\UserTestAnswerRepository;
use Illuminate\Http\JsonResponse;
use App\Models\UserTestAnswer;
use Illuminate\Support\Facades\Gate;
/**
 * @group UserTestAnswer
 *
 */
class UserTestAnswerController extends Controller
{

    public function __construct(public UserTestAnswerRepository $userTestAnswerRepository)
    {
    }

    /**
    * UserTestAnswer Get all
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function index(Request $request)
    {
        return $this->userTestAnswerRepository->index($request);
    }

    /**
    * UserTestAnswer adminIndex get All
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function adminIndex(Request $request)
    {
        Gate::authorize('test-answers.view');

        return $this->userTestAnswerRepository->adminIndex($request);
    }

    /**
    * UserTestAnswer view
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

    public function show(Request $request, UserTestAnswer $userTestAnswer): JsonResponse
    {
        return $this->userTestAnswerRepository->show($request, $userTestAnswer);
    }

    /**
    * UserTestAnswer create
    *
         * @bodyParam session_id integer
     * @bodyParam test_id integer
     * @bodyParam question_id integer
     * @bodyParam answer_id integer
     * @bodyParam is_correct boolean
     * @bodyParam answered_at date

    *
    * @param StoreUserTestAnswerRequest $request
    * @return JsonResponse
    */

    public function store(StoreUserTestAnswerRequest $request): JsonResponse
    {
        Gate::authorize('test-answers.create');

        return $this->userTestAnswerRepository->store($request);
    }

    /**
    * UserTestAnswer update
    *
    * @queryParam userTestAnswer required
    *
         * @bodyParam session_id integer
     * @bodyParam test_id integer
     * @bodyParam question_id integer
     * @bodyParam answer_id integer
     * @bodyParam is_correct boolean
     * @bodyParam answered_at date

    *
    * @param UpdateUserTestAnswerRequest $request
    * @param UserTestAnswer $userTestAnswer
    * @return JsonResponse
    */

    public function update(UpdateUserTestAnswerRequest $request, UserTestAnswer $userTestAnswer): JsonResponse
    {
        Gate::authorize('test-answers.update');

         return $this->userTestAnswerRepository->update($request, $userTestAnswer);
    }

    /**
     * UserTestAnswer delete
     *
     * @queryParam userTestAnswer required
     *
     * @param UserTestAnswer $userTestAnswer
     * @return JsonResponse
     */

    public function destroy(UserTestAnswer $userTestAnswer): JsonResponse
    {
        Gate::authorize('test-answers.delete');

        return  $this->userTestAnswerRepository->destroy($userTestAnswer);
    }
}
