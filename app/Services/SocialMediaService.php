<?php

namespace App\Services;

use App\Repositories\SocialMediaRepository;

class SocialMediaService extends BaseService
{
    public function __construct(SocialMediaRepository $repository)
    {
        $this->repository = $repository;
    }
}