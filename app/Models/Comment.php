<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CreatedAtScope;

class Comment extends Model
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
    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CreatedAtScope);
    }

    /**
     * Scope is approved attribute
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param int $status
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeApproved($query, $status)
    {
        return $query->where('is_approved', $status);
    }

    /**
     * Scope is subscribed attribute
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param int $status
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeSubscribed($query, $status)
    {
        return $query->where('is_subscribed', $status);
    }

    /**
     * Get is Approved attribute
     *
     * @param mixed $attribute
     * @return void
     */
    public function getIsApprovedAttribute($attribute)
    {
        return [
            1 => 'Approved',
            0 => 'Unapproved'
        ][$attribute];
    }

    /**
     * Get is subscribed attribute
     *
     * @param mixed $attribute
     * @return void
     */
    public function getIsSubscribedAttribute($attribute)
    {
        return [
            1 => 'Subscribed',
            0 => 'Not Subscribed'
        ][$attribute];
    }

    /**
     * Trim and convert first name to lower case before save
     *
     * @param string $value
     * @return void
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = trim(strtolower($value));
    }

    /**
     * Trim and convert last name to lower case before save
     *
     * @param string $value
     * @return void
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = trim(strtolower($value));
    }

    /**
     * Trim and and replace anchor tags for body before save
     *
     * @param string $value
     * @return void
     */
    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = trim(str_replace(['<a>', '</a>'], " ", $value));
    }

    /**
     * Convert first name to capitalize case
     *
     * @param string $value
     * @return string $value First name
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Convert last name to capitalize case
     *
     * @param string $value
     * @return string $value First name
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Comment Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Comment Parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Comment children
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->HasMany(Comment::class, 'parent_id');
    }
}
