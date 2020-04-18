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

if( !function_exists('breadcrum_route_name') )
{
    /**
     * Get breadcrumb route name
     *
     * @param string $segment current loop item
     * @param integer $iteration current loop index
     * @return string route
     */
    function breadcrumb_route_name(string $segment, int $iteration) : string
    {
        if((int) $iteration === 3)
        {
            $parent = request()->segment(2);
            $slug = request()->segment(4);

            return route("$parent.$segment", $slug);
        }

        return route($segment);
    }
}
