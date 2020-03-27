<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', 0);
    }

    public function getActiveAttribute($attribute)
    {
        return [
            0 => 'Active',
            1 => 'Inactive'
        ][$attribute];
    }
}
