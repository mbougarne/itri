<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Scopes\CreatedAtScope;

class Post extends Model
{
    /**
     * Allow mass assignments
     * @var array
      */
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

    /**
     * Scope is published where query
     *
     * @param int $status
     * @param \Illuminate\Database\Query\Builder  $query
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopePublished($query, int $status)
    {
        return $query->where('is_published', $status);
    }

    /**
     * Get post's status based in is_published value
     *
     * @param int|string $attribute
     * @return array
     */
    public function getIsPublishedAttribute($attribute)
    {
        return [
            1 => 'Published',
            0 => 'Draft'
        ][$attribute];
    }

    /**
     * Trim the post's title and change case to lower before saving
     *
     * @param string $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = trim(strtolower($value));
    }

    /**
     * Get post's title in Title case
     *
     * @param string $value
     * @return string post's title
     */
    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Get post's thumbnail
     *
     * @param string $value
     * @return string
     */
    public function getThumbnailAttribute($value)
    {
        return ($value) ? 'uploads/thumbnails/' . $value : 'img/default-latest-post.jpg';
    }

    /**
     * Post categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post', 'category_id', 'post_id')->withTimestamps();
    }

    /**
     * Post tags
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_post', 'tag_id', 'post_id')->withTimestamps();
    }

    /**
     * Post comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
