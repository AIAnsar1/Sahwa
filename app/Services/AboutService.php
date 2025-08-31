<?php

namespace App\Services;

use App\Repositories\AboutRepository;

class AboutService extends BaseService
{
    public function __construct(AboutRepository $repository)
    {
        $this->repository = $repository;
    }
}