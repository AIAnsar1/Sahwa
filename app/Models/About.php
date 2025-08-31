<?php

namespace App\Models;


class About extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'photo',
        'description',
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
        'title' => 'string',
        'content' => 'string',
        'photo' => 'string',
        'description' => 'string',
    ];
    
    public $translatable = [

    ];
}
