<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['author_id', 'title', 'description', 'content', 'keywords', 'category', 'image', 'slug', 'locale','parent_id'];

    protected static function booted(): void
    {
        static::created(function (Post $post) {
            if ($post->locale === 'tr' && empty($post->parent_id)) {
                $post->update(['parent_id' => $post->id]);
            }
        });
    }
}
