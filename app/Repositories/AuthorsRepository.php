<?php

namespace App\Repositories;

use App\Models\Authors;

class AuthorsRepository extends BaseRepository
{
    public function __construct(Authors $model)
    {
        parent::__construct($model);
    }
}