<?php

namespace App\Services;

use App\Repositories\PartnersRepository;

class PartnersService extends BaseService
{
    public function __construct(PartnersRepository $repository)
    {
        $this->repository = $repository;
    }
}