<?php

namespace App\Repositories;

use App\Models\Partners;

class PartnersRepository extends BaseRepository
{
    public function __construct(Partners $model)
    {
        parent::__construct($model);
    }
}