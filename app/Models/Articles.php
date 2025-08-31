<?php

namespace App\Models;


use Qirolab\Laravel\Reactions\Traits\Reacts;
use Cviebrock\EloquentSluggable\Sluggable;

class Articles extends BaseModel
{
    use Reacts, Sluggable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'views',
        'thumbnail',
        'like',
        'categories_id',
        'authors_id',
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
        'views' => 'integer',
        'like' => 'integer',
    ];
    
    public $translatable = [
        
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function tags()
    {
        $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
