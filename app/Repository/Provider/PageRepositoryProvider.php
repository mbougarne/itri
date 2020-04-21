<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class PageRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Contracts\PageRepositoryInterface',
            'App\Repository\PageRepository'
        );
    }
}
