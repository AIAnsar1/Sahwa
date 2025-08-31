<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\About;
use App\Services\AboutService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreAboutRequest;
use App\Http\Requests\UpdateRequest\UpdateAboutRequest;


class AboutController extends Controller
{
    /**
     * @var AboutService
     */
    private AboutService $service;

    /**
     * @param AboutService $service
     */
    public function __construct(AboutService $service)
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
        return AboutResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StoreAboutRequest $request
     * @return array|Builder|Collection|About
     * @throws Throwable
     */
    public function store(StoreAboutRequest $request): array|Builder|Collection|About
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $
     * @return AboutResource
     * @throws Throwable
     */
    public function show(int $about_id)
    {
        return new AboutResource($this->service->getModelById($about_id));
    }

    /**
     * @param UpdateAboutRequest $request
     * @param int $
     * @return array|About|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateAboutRequest $request, int $about_id): array|About|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $about_id);

    }

    /**
     * @param int $
     * @return array|Builder|Collection|About
     * @throws Throwable
     */
    public function destroy(int $about_id): array|Builder|Collection|About
    {
        return $this->service->deleteModel($about_id);
    }
}

