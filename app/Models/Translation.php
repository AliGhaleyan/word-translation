<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Translation
 * @package App\Models
 *
 *
 * @property $title
 * @property $slug
 * @property $part_speech
 * @property $word_id
 */
class Translation extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        "title", "slug", "part_speech", "word_id"
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
