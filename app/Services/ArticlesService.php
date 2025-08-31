<?php

namespace App\Services;

use App\Repositories\ArticlesRepository;

class ArticlesService extends BaseService
{
    public function __construct(ArticlesRepository $repository)
    {
        $this->repository = $repository;
    }
}