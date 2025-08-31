<?php

namespace App\Models;


class SocialMedia extends BaseModel
{
    protected $table = "social_medias";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'platform',
        'url',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'platform' => 'string',
        'url' => 'string',
    ];
    
    public $translatable = [

    ];
}
