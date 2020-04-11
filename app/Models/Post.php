<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Scopes\CreatedAtScope;

class Post extends Model
{
    protected $guarded = [];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->slug = Str::slug($query->title);
        });

        static::addGlobalScope(new CreatedAtScope);
    }



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

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    public function getThumbnailAttribute($value)
    {
        return ($value) ? 'uploads/thumbnails/' . $value : 'img/default-latest-post.jpg';
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
