<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService extends BaseService
{
    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }
}