<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorsResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Authors;
use App\Services\AuthorsService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreAuthorsRequest;
use App\Http\Requests\UpdateRequest\UpdateAuthorsRequest;


class AuthorsController extends Controller
{
    /**
     * @var AuthorsService
     */
    private AuthorsService $service;

    /**
     * @param AuthorsService $service
     */
    public function __construct(AuthorsService $service)
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
        return AuthorsResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StoreAuthorsRequest $request
     * @return array|Builder|Collection|Authors
     * @throws Throwable
     */
    public function store(StoreAuthorsRequest $request): array|Builder|Collection|Authors
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $
     * @return AuthorsResource
     * @throws Throwable
     */
    public function show(int $author_id)
    {
        return new AuthorsResource($this->service->getModelById($author_id));
    }

    /**
     * @param UpdateAuthorsRequest $request
     * @param int $
     * @return array|Authors|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateAuthorsRequest $request, int $author_id): array|Authors|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $author_id);

    }

    /**
     * @param int $
     * @return array|Builder|Collection|Authors
     * @throws Throwable
     */
    public function destroy(int $author_id): array|Builder|Collection|Authors
    {
        return $this->service->deleteModel($author_id);
    }
}

