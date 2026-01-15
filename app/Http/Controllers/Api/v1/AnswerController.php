<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Answer\StoreAnswerRequest;
use App\Http\Requests\Answer\UpdateAnswerRequest;
use App\Http\Repositories\v1\AnswerRepository;
use Illuminate\Http\JsonResponse;
use App\Models\Answer;
use Illuminate\Support\Facades\Gate;
/**
 * @group Answer
 *
 */
class AnswerController extends Controller
{

    public function __construct(public AnswerRepository $answerRepository)
    {
    }

    /**
    * Answer Get all
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function index(Request $request)
    {
        return $this->answerRepository->index($request);
    }

    /**
    * Answer adminIndex get All
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function adminIndex(Request $request)
    {
        Gate::authorize('answers.view');

        return $this->answerRepository->adminIndex($request);
    }

    /**
    * Answer view
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

    public function show(Request $request, Answer $answer): JsonResponse
    {
        return $this->answerRepository->show($request, $answer);
    }

    /**
    * Answer create
    *
         * @bodyParam question_id integer
     * @bodyParam answer_text string
     * @bodyParam is_correct boolean
     * @bodyParam type integer

    *
    * @param StoreAnswerRequest $request
    * @return JsonResponse
    */

    public function store(StoreAnswerRequest $request): JsonResponse
    {
        Gate::authorize('answers.create');

        return $this->answerRepository->store($request);
    }

    /**
    * Answer update
    *
    * @queryParam answer required
    *
         * @bodyParam question_id integer
     * @bodyParam answer_text string
     * @bodyParam is_correct boolean
     * @bodyParam type integer

    *
    * @param UpdateAnswerRequest $request
    * @param Answer $answer
    * @return JsonResponse
    */

    public function update(UpdateAnswerRequest $request, Answer $answer): JsonResponse
    {
        Gate::authorize('answers.update');

         return $this->answerRepository->update($request, $answer);
    }

    /**
     * Answer delete
     *
     * @queryParam answer required
     *
     * @param Answer $answer
     * @return JsonResponse
     */

    public function destroy(Answer $answer): JsonResponse
    {
        Gate::authorize('answers.delete');

        return  $this->answerRepository->destroy($answer);
    }
}
