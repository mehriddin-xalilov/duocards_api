<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Speciality\StoreSpecialityRequest;
use App\Http\Requests\Speciality\UpdateSpecialityRequest;
use App\Http\Repositories\v1\SpecialityRepository;
use Illuminate\Http\JsonResponse;
use App\Models\Speciality;
use Illuminate\Support\Facades\Gate;
/**
 * @group Speciality
 *
 */
class SpecialityController extends Controller
{

    public function __construct(public SpecialityRepository $specialityRepository)
    {
    }

    /**
    * Speciality Get all
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function index(Request $request)
    {
        return $this->specialityRepository->index($request);
    }

    /**
    * Speciality adminIndex get All
    *
    * @response {
    {{response}}
    * }
    * @return JsonResponse
    */

    public function adminIndex(Request $request)
    {
        Gate::authorize('specialities.view');

        return $this->specialityRepository->adminIndex($request);
    }

    /**
    * Speciality view
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

    public function show(Request $request, Speciality $speciality): JsonResponse
    {
        return $this->specialityRepository->show($request, $speciality);
    }

    /**
    * Speciality create
    *
         * @bodyParam name string
     * @bodyParam description string

    *
    * @param StoreSpecialityRequest $request
    * @return JsonResponse
    */

    public function store(StoreSpecialityRequest $request): JsonResponse
    {
        Gate::authorize('specialities.create');

        return $this->specialityRepository->store($request);
    }

    /**
    * Speciality update
    *
    * @queryParam speciality required
    *
         * @bodyParam name string
     * @bodyParam description string

    *
    * @param UpdateSpecialityRequest $request
    * @param Speciality $speciality
    * @return JsonResponse
    */

    public function update(UpdateSpecialityRequest $request, Speciality $speciality): JsonResponse
    {
        Gate::authorize('specialities.update');

         return $this->specialityRepository->update($request, $speciality);
    }

    /**
     * Speciality delete
     *
     * @queryParam speciality required
     *
     * @param Speciality $speciality
     * @return JsonResponse
     */

    public function destroy(Speciality $speciality): JsonResponse
    {
        Gate::authorize('specialities.delete');

        return  $this->specialityRepository->destroy($speciality);
    }
}
