<?php

namespace App\Http\Controllers;

use App\Http\Resources\PartnersResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Partners;
use App\Services\PartnersService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StorePartnersRequest;
use App\Http\Requests\UpdateRequest\UpdatePartnersRequest;


class PartnersController extends Controller
{
    /**
     * @var PartnersService
     */
    private PartnersService $service;

    /**
     * @param PartnersService $service
     */
    public function __construct(PartnersService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws Throwable
     */
    public function index(Request $request)
    {
        return PartnersResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StorePartnersRequest $request
     * @return array|Builder|Collection|Partners
     * @throws Throwable
     */
    public function store(StorePartnersRequest $request): array|Builder|Collection|Partners
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $partners_id
     * @return PartnersResource
     * @throws Throwable
     */
    public function show(int $partners_id)
    {
        return new PartnersResource($this->service->getModelById($partners_id));
    }

    /**
     * @param UpdatePartnersRequest $request
     * @param int $partners_id
     * @return array|Partners|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdatePartnersRequest $request, int $partners_id): array|Partners|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $partners_id);

    }

    /**
     * @param int $partners_id
     * @return array|Builder|Collection|Partners
     * @throws Throwable
     */
    public function destroy(int $partners_id): array|Builder|Collection|Partners
    {
        return $this->service->deleteModel($partners_id);
    }
}

