<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class CommentRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Contracts\CommentRepositoryInterface',
            'App\Repository\CommentRepository');
    }
}
