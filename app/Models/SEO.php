<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SEO extends Model
{
    protected $table = 'seo';
    protected $guarded = [];

    public function page()
    {
        return $this->hasMany(Page::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

}
