<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticlesResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Articles;
use App\Services\ArticlesService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreArticlesRequest;
use App\Http\Requests\UpdateRequest\UpdateArticlesRequest;


class ArticlesController extends Controller
{
    /**
     * @var ArticlesService
     */
    private ArticlesService $service;

    /**
     * @param ArticlesService $service
     */
    public function __construct(ArticlesService $service)
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
        return ArticlesResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StoreArticlesRequest $request
     * @return array|Builder|Collection|Articles
     * @throws Throwable
     */
    public function store(StoreArticlesRequest $request): array|Builder|Collection|Articles
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $
     * @return ArticlesResource
     * @throws Throwable
     */
    public function show(int $article_id)
    {
        return new ArticlesResource($this->service->getModelById($article_id));
    }

    /**
     * @param UpdateArticlesRequest $request
     * @param int $
     * @return array|Articles|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateArticlesRequest $request, int $article_id): array|Articles|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $article_id);

    }

    /**
     * @param int $
     * @return array|Builder|Collection|Articles
     * @throws Throwable
     */
    public function destroy(int $article_id): array|Builder|Collection|Articles
    {
        return $this->service->deleteModel($article_id);
    }
}

