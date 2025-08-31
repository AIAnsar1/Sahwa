<?php

namespace App\Repositories;

use App\Models\About;

class AboutRepository extends BaseRepository
{
    public function __construct(About $model)
    {
        parent::__construct($model);
    }
}