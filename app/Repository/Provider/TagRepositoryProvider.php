<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class TagRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Contracts\TagRepositoryInterface',
            'App\Repository\TagRepository'
        );
    }
}
