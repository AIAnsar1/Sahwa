<?php

namespace App\Models;


class Authors extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "bio",
        "position",
        "users_id",
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
        return $this->hasMany(Articles::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
