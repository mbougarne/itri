<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        return static::creating( function($query) {
            $query->slug = Str::slug($query->name);
        });
    }

    public function scopeChild($query)
    {
        return $query->where('is_sub', 1);
    }

    public function scopeParent($query)
    {
        return $query->where('is_active', 0);
    }

    public function getIsSubAttribute($attribute)
    {
        return [
            0 => 'Parent',
            1 => 'Sub Category'
        ][$attribute];
    }

    public function getThumbnailAttribute($value)
    {
        return ($value) ? 'uploads/categories/' . $value : 'img/default-latest-post.jpg';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'post_id', 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->HasMany(Category::class);
    }

}
