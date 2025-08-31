<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentsResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\Comments;
use App\Services\CommentsService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreCommentsRequest;
use App\Http\Requests\UpdateRequest\UpdateCommentsRequest;


class CommentsController extends Controller
{
    /**
     * @var CommentsService
     */
    private CommentsService $service;

    /**
     * @param CommentsService $service
     */
    public function __construct(CommentsService $service)
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
        return CommentsResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StoreCommentsRequest $request
     * @return array|Builder|Collection|Comments
     * @throws Throwable
     */
    public function store(StoreCommentsRequest $request): array|Builder|Collection|Comments
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $
     * @return CommentsResource
     * @throws Throwable
     */
    public function show(int $comment_id)
    {
        return new CommentsResource($this->service->getModelById($comment_id));
    }

    /**
     * @param UpdateCommentsRequest $request
     * @param int $
     * @return array|Comments|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateCommentsRequest $request, int $comment_id): array|Comments|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $comment_id);
    }

    /**
     * @param int $
     * @return array|Builder|Collection|Comments
     * @throws Throwable
     */
    public function destroy(int $comment_id): array|Builder|Collection|Comments
    {
        return $this->service->deleteModel($comment_id);
    }
}

