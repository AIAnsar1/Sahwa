<?php

namespace App\Services;

use App\Repositories\CommentsRepository;

class CommentsService extends BaseService
{
    public function __construct(CommentsRepository $repository)
    {
        $this->repository = $repository;
    }
}