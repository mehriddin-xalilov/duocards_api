<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Http\Repositories\v1\QuestionRepository;
use Illuminate\Http\JsonResponse;
use App\Models\Question;
use Illuminate\Support\Facades\Gate;

/**
 * @group Question
 *
 */
class QuestionController extends Controller
{

    public function __construct(public QuestionRepository $questionRepository) {}

    /**
     * Question Get all
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function index(Request $request)
    {
        return $this->questionRepository->index($request);
    }

    /**
     * Question adminIndex get All
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function adminIndex(Request $request)
    {
        Gate::authorize('questions.view');

        return $this->questionRepository->adminIndex($request);
    }

    /**
     * Question view
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

    public function show(Request $request, Question $question): JsonResponse
    {
        return $this->questionRepository->show($request, $question);
    }

    /**
     * Question create
     *
     * @bodyParam level_id integer
     * @bodyParam category_id integer
     * @bodyParam question_text string
     * @bodyParam type integer

     *
     * @param StoreQuestionRequest $request
     * @return JsonResponse
     */

    public function store(StoreQuestionRequest $request): JsonResponse
    {
        Gate::authorize('questions.create');

        return $this->questionRepository->store($request);
    }

    /**
     * Question update
     *
     * @queryParam question required
     *
     * @bodyParam level_id integer
     * @bodyParam category_id integer
     * @bodyParam question_text string
     * @bodyParam type integer

     *
     * @param UpdateQuestionRequest $request
     * @param Question $question
     * @return JsonResponse
     */

    public function update(UpdateQuestionRequest $request, Question $question): JsonResponse
    {
        Gate::authorize('questions.update');

        return $this->questionRepository->update($request, $question);
    }

    /**
     * Question delete
     *
     * @queryParam question required
     *
     * @param Question $question
     * @return JsonResponse
     */

    public function destroy(Question $question): JsonResponse
    {
        Gate::authorize('questions.delete');

        return  $this->questionRepository->destroy($question);
    }
}
