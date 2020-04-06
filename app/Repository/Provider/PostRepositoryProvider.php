<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class PostRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Contracts\PostRepositoryInterface',
            'App\Repository\PostRepository');
    }
}
