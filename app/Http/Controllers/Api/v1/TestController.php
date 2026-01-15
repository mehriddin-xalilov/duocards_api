<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Test\StoreTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;
use App\Http\Repositories\v1\TestRepository;
use Illuminate\Http\JsonResponse;
use App\Models\Test;
use Illuminate\Support\Facades\Gate;
/**
 * @group Test
 *
 */
class TestController extends Controller
{

    public function __construct(public TestRepository $testRepository)
    {
    }

    /**
    * Test Get all
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function index(Request $request)
    {
        return $this->testRepository->index($request);
    }

    /**
    * Test adminIndex get All
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function adminIndex(Request $request)
    {
        Gate::authorize('tests.view');

        return $this->testRepository->adminIndex($request);
    }

    /**
    * Test view
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

    public function show(Request $request, Test $test): JsonResponse
    {
        return $this->testRepository->show($request, $test);
    }

    /**
    * Test create
    *
         * @bodyParam name string
     * @bodyParam category_id integer
     * @bodyParam level_id integer
     * @bodyParam time_limit integer
     * @bodyParam questions_count integer
     * @bodyParam randomize_questions boolean
     * @bodyParam randomize_answers boolean

    *
    * @param StoreTestRequest $request
    * @return JsonResponse
    */

    public function store(StoreTestRequest $request): JsonResponse
    {
        Gate::authorize('tests.create');

        return $this->testRepository->store($request);
    }

    /**
    * Test update
    *
    * @queryParam test required
    *
         * @bodyParam name string
     * @bodyParam category_id integer
     * @bodyParam level_id integer
     * @bodyParam time_limit integer
     * @bodyParam questions_count integer
     * @bodyParam randomize_questions boolean
     * @bodyParam randomize_answers boolean

    *
    * @param UpdateTestRequest $request
    * @param Test $test
    * @return JsonResponse
    */

    public function update(UpdateTestRequest $request, Test $test): JsonResponse
    {
        Gate::authorize('tests.update');

         return $this->testRepository->update($request, $test);
    }

    /**
     * Test delete
     *
     * @queryParam test required
     *
     * @param Test $test
     * @return JsonResponse
     */

    public function destroy(Test $test): JsonResponse
    {
        Gate::authorize('tests.delete');

        return  $this->testRepository->destroy($test);
    }
}
