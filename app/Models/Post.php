<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    protected $guarded = [];

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_published', 0);
    }

    public function getIsPublishedAttribute($attribute)
    {
        return [
            1 => 'Published',
            0 => 'Draft'
        ][$attribute];
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function getThumbnail()
    {
        return (!is_null($this->thumbnail)) ? 'uploads/thumbnails/' . $this->thumbnail : 'img/default-latest-post.jpg';
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'category_id', 'post_id')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_post', 'tag_id', 'post_id')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
