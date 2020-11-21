<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Word
 * @package App\Models
 *
 * @property $title
 * @property $slug
 *
 * @method static Builder filter()
 */
class Word extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        "title", "slug",
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function translations()
    {
        return $this->hasMany(Translation::class);
    }


    public function scopeFilter(Builder $query)
    {
        $title = request("title");

        if (isset($title) && $title)
            $query->where("title", "like", "%{$title}%");

        return $query;
    }
}
