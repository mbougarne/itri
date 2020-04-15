<?php

/**
 * Custom helpers function for getting current route for active status
 */

use Illuminate\Support\Facades\Route;

if( !function_exists('route_active_status') )
{
    function route_active_status(string $route_name) : string
    {
        return Route::currentRouteNamed($route_name) ? 'active' : '';
    }
}
