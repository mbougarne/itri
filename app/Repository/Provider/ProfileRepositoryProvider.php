<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class ProfileRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Contracts\ProfileRepositoryInterface',
            'App\Repository\ProfileRepository'
        );
    }
}
