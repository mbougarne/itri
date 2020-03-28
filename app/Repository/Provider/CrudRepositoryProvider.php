<?php

namespace App\Repository\Provider;

use Illuminate\Support\ServiceProvider;

class CrudRepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app
            ->when('App\Http\Controllers\UserController')
            ->needs('App\Repository\Contracts\CrudRepositoryInterface')
            ->give('App\Repository\UserRepository');
    }
}
