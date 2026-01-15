<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Level\StoreLevelRequest;
use App\Http\Requests\Level\UpdateLevelRequest;
use App\Http\Repositories\v1\LevelRepository;
use Illuminate\Http\JsonResponse;
use App\Models\Level;
use Illuminate\Support\Facades\Gate;

/**
 * @group Level
 *
 */
class LevelController extends Controller
{

    public function __construct(public LevelRepository $levelRepository) {}

    /**
     * Level Get all
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function index(Request $request)
    {
        return $this->levelRepository->index($request);
    }

    /**
     * Level adminIndex get All
     *
     * @response {
    {{response}}
     * }
     * @return JsonResponse
     */

    public function adminIndex(Request $request)
    {
        Gate::authorize('levels.view');
        return $this->levelRepository->adminIndex($request);
    }

    /**
     * Level view
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

    public function show(Request $request, Level $level): JsonResponse
    {
        return $this->levelRepository->show($request, $level);
    }

    /**
     * Level create
     *
     * @bodyParam name json
     * @bodyParam type integer

     *
     * @param StoreLevelRequest $request
     * @return JsonResponse
     */

    public function store(StoreLevelRequest $request): JsonResponse
    {
        Gate::authorize('levels.create');
        return $this->levelRepository->store($request);
    }

    /**
     * Level update
     *
     * @queryParam level required
     *
     * @bodyParam name json
     * @bodyParam type integer

     *
     * @param UpdateLevelRequest $request
     * @param Level $level
     * @return JsonResponse
     */

    public function update(UpdateLevelRequest $request, Level $level): JsonResponse
    {
        Gate::authorize('levels.update');
        return $this->levelRepository->update($request, $level);
    }

    /**
     * Level delete
     *
     * @queryParam level required
     *
     * @param Level $level
     * @return JsonResponse
     */

    public function destroy(Level $level): JsonResponse
    {
        Gate::authorize('levels.delete');
        return $this->levelRepository->destroy($level);
    }
}
