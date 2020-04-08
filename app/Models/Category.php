<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

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

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'post_id', 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function childs()
    {
        return $this->HasMany(Category::class);
    }

}
