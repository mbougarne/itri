<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function scopeReply($query)
    {
        return $query->where('is_reply', 1);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    public function getIsApprovedAttribute($attribute)
    {
        return [
            1 => 'Approved',
            0 => 'Unapproved'
        ][$attribute];
    }

    public function getIsSubscribedAttribute($attribute)
    {
        return [
            1 => 'Subscribed',
            0 => 'Not Subscribed'
        ][$attribute];
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }

    public function childs()
    {
        return $this->HasMany(Comment::class);
    }
}
