<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['author_id','title','content','locale','parent_id'];

    protected static function booted(): void
    {
        static::created(function (Service $service) {
            if ($service->locale === 'tr' && empty($service->parent_id)) {
                $service->update(['parent_id' => $service->id]);
            }
        });
    }
}
