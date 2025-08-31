<?php

namespace App\Repositories;

use App\Models\Articles;

class ArticlesRepository extends BaseRepository
{
    public function __construct(Articles $model)
    {
        parent::__construct($model);
    }
}