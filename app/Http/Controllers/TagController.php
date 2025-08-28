<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreTagRequest;
use App\Http\Requests\UpdateRequest\UpdateTagRequest;


class TagController extends Controller
{
    /**
     * @var TagService
     */
    private TagService $service;

    /**
     * @param TagService $service
     */
    public function __construct(TagService $service)
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
        return TagResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StoreTagRequest $request
     * @return array|Builder|Collection|Tag
     * @throws Throwable
     */
    public function store(StoreTagRequest $request): array |Builder|Collection|Tag
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $
     * @return TagResource
     * @throws Throwable
     */
    public function show(int $tag_id)
    {
        return new TagResource( $this->service->getModelById($tag_id));
    }

    /**
     * @param UpdateTagRequest $request
     * @param int $
     * @return array|Tag|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateTagRequest $request, int $tag_id): array |Tag|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $tag_id);

    }

    /**
     * @param int $
     * @return array|Builder|Collection|Tag
     * @throws Throwable
     */
    public function destroy(int $tag_id): array |Builder|Collection|Tag
    {
        return $this->service->deleteModel($tag_id);
    }
}

