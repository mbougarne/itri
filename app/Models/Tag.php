<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function($query) {
            $query->slug = Str::slug($query->name);
        });

    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'tag_post', 'post_id', 'tag_id');
    }
}
