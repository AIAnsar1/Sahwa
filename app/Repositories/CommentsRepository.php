<?php

namespace App\Repositories;

use App\Models\Comments;

class CommentsRepository extends BaseRepository
{
    public function __construct(Comments $model)
    {
        parent::__construct($model);
    }
}