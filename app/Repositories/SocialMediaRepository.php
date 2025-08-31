<?php

namespace App\Repositories;

use App\Models\SocialMedia;

class SocialMediaRepository extends BaseRepository
{
    public function __construct(SocialMedia $model)
    {
        parent::__construct($model);
    }
}