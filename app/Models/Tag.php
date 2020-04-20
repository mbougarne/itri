<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    /**
     * Allow mass assignment
     *
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

        static::creating(function($query) {
            $query->slug = Str::slug($query->name);
        });

    }

    /**
     * Trim and convert the tag name to lower case before saving
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribuet($value)
    {
        $this->attributes['name'] = trim(strtolower($value));
    }

    /**
     * Get slug name in title case
     *
     * @param string $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get tag posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelonsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'tag_post', 'post_id', 'tag_id');
    }
}
