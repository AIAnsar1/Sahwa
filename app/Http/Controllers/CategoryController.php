<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreCategoryRequest;
use App\Http\Requests\UpdateRequest\UpdateCategoryRequest;


class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    private CategoryService $service;

    /**
     * @param CategoryService $service
     */
    public function __construct(CategoryService $service)
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
        return CategoryResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StoreCategoryRequest $request
     * @return array|Builder|Collection|Category
     * @throws Throwable
     */
    public function store(StoreCategoryRequest $request): array|Builder|Collection|Category
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $
     * @return CategoryResource
     * @throws Throwable
     */
    public function show(int $category_id)
    {
        return new CategoryResource($this->service->getModelById($category_id));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param int $
     * @return array|Category|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateCategoryRequest $request, int $category_id): array|Category|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $category_id);

    }

    /**
     * @param int $
     * @return array|Builder|Collection|Category
     * @throws Throwable
     */
    public function destroy(int $category_id): array|Builder|Collection|Category
    {
        return $this->service->deleteModel($category_id);
    }
}

