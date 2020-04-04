<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
            0 => 'Published',
            1 => 'Draft'
        ][$attribute];
    }

    public function getThumbnail()
    {
        return (!is_null($this->thumbnail)) ? 'uploads/thumbnails/' . $this->thumbnail : 'img/default-latest-post.jpg';
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
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
