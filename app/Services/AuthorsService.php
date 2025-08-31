<?php

namespace App\Services;

use App\Repositories\AuthorsRepository;

class AuthorsService extends BaseService
{
    public function __construct(AuthorsRepository $repository)
    {
        $this->repository = $repository;
    }
}