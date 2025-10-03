<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $casts = [
        'features' => 'array',
        'images' => 'array',
    ];

    protected $fillable = ['author_id', 'title', 'description', 'content', 'features', 'images', 'category', 'locale','parent_id', 'slug', 'stage'];

    protected static function booted(): void
    {
        static::created(function (Portfolio $portfolio) {
            if ($portfolio->locale === 'tr' && empty($portfolio->parent_id)) {
                $portfolio->update(['parent_id' => $portfolio->id]);
            }
        });
    }
}
