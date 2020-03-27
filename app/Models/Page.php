<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
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

    public function seo()
    {
        return $this->belongsTo(SEO::class);
    }

    public function graphs()
    {
        return $this->belongsTo(OpenGraph::class);
    }

    public function items()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
