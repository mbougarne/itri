<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpenGraph extends Model
{
    protected $table = 'open_graphs';
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
