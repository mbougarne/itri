<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
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
    protected static function booted()
    {
        return static::creating( function($query) {
            $query->slug = Str::slug($query->name);
        });
    }

    /**
     * Set category name in lower case
     *
     * @param string $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * Get category name in title case format
     *
     * @param string $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Get is_sub in text format
     *
     * @param mixed $attribute
     * @return array
     */
    public function getIsSubAttribute($attribute)
    {
        return [
            0 => 'Parent',
            1 => 'Sub Category'
        ][$attribute];
    }

    /**
     * Get thumbnail path if exist or null cases
     *
     * @param string $value
     * @return string $value of thumbnail path
     */
    public function getThumbnailAttribute($value)
    {
        return ($value) ? 'uploads/categories/' . $value : 'img/default-latest-post.jpg';
    }

    /**
     * Get category parent
     *
     * @return array
     */
    public function getParent() : array
    {
        [ 'id' => $id, 'slug' => $slug, 'name' => $name ] = $this->parent->getAttributes();

        return [ $id, $slug, $name ];
    }

    /**
     * Get Children
     *
     * @return array
     */
    public function getChildren() : array
    {
        return $this->children()->get(['id', 'slug', 'name'])->toArray();
    }

    /**
     * Category posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post', 'post_id', 'category_id');
    }

    /**
     * Parent category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Children categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->HasMany(Category::class, 'parent_id', 'id');
    }

}
