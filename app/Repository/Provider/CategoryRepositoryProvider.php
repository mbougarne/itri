<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class CategoryRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Contracts\CategoryRepositoryInterface',
            'App\Repository\categoryRepository'
        );
    }
}
