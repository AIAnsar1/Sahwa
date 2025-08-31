<?php

namespace App\Http\Controllers;

use App\Http\Resources\SocialMediaResource;
use Illuminate\Http\Request;
use Throwable;
use App\Models\SocialMedia;
use App\Services\SocialMediaService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreRequest\StoreSocialMediaRequest;
use App\Http\Requests\UpdateRequest\UpdateSocialMediaRequest;


class SocialMediaController extends Controller
{
    /**
     * @var SocialMediaService
     */
    private SocialMediaService $service;

    /**
     * @param SocialMediaService $service
     */
    public function __construct(SocialMediaService $service)
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
        return SocialMediaResource::collection($this->service->paginatedList($request->all()));
    }

    /**
     * @param StoreSocialMediaRequest $request
     * @return array|Builder|Collection|SocialMedia
     * @throws Throwable
     */
    public function store(StoreSocialMediaRequest $request): array|Builder|Collection|SocialMedia
    {
        return $this->service->createModel($request->validated());

    }

    /**
     * @param $social_media_id
     * @return SocialMediaResource
     * @throws Throwable
     */
    public function show(int $social_media_id)
    {
        return new SocialMediaResource($this->service->getModelById($social_media_id));
    }

    /**
     * @param UpdateSocialMediaRequest $request
     * @param int $social_media_id
     * @return array|SocialMedia|Collection|Builder
     * @throws Throwable
     */
    public function update(UpdateSocialMediaRequest $request, int $social_media_id): array|SocialMedia|Collection|Builder
    {
        return $this->service->updateModel($request->validated(), $social_media_id);

    }

    /**
     * @param int $social_media_id
     * @return array|Builder|Collection|SocialMedia
     * @throws Throwable
     */
    public function destroy(int $social_media_id): array|Builder|Collection|SocialMedia
    {
        return $this->service->deleteModel($social_media_id);
    }
}

