<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Repositories\v1\CategoryRepository;
use Illuminate\Http\JsonResponse;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

/**
 * @group Category
 *
 */
class CategoryController extends Controller
{

    public function __construct(public CategoryRepository $categoryRepository) {}

    /**
     * Category Get all
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function index(Request $request)
    {
        return $this->categoryRepository->index($request);
    }

    /**
     * Category adminIndex get All
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function adminIndex(Request $request)
    {
        Gate::authorize('categories.view');
        return $this->categoryRepository->adminIndex($request);
    }

    /**
     * Category view
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

    public function show(Request $request, Category $category): JsonResponse
    {
        return $this->categoryRepository->show($request, $category);
    }

    /**
     * Category create
     *
     * @bodyParam name string
     * @bodyParam parent_id integer

     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        Gate::authorize('categories.create');
        return $this->categoryRepository->store($request);
    }

    /**
     * Category update
     *
     * @queryParam category required
     *
     * @bodyParam name string
     * @bodyParam parent_id integer

     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        Gate::authorize('categories.update');
        return $this->categoryRepository->update($request, $category);
    }

    /**
     * Category delete
     *
     * @queryParam category required
     *
     * @param Category $category
     * @return JsonResponse
     */

    public function destroy(Category $category): JsonResponse
    {
        Gate::authorize('categories.delete');
        return $this->categoryRepository->destroy($category);
    }
}
