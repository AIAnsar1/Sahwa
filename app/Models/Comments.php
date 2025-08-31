<?php

namespace App\Models;


class Comments extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'users_id',
        'articles_id',
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

    ];

    public $translatable = [

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }


    public function articles()
    {
        return $this->belongsTo(Articles::class, 'articles_id');
    }
}
