<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repository\Contracts\UserRepositoryInterface',
            'App\Repository\UserRepository'
        );
    }
}
