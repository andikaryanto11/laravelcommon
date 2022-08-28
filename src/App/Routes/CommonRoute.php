<?php

namespace LaravelCommon\App\Routes;

use LaravelCommon\Exceptions\RouteException;

class CommonRoute
{
    /**
     * register a route
     *
     * @return void
     */
    public static function register()
    {
        throw new RouteException('"CommonRoute::register" function need to be overrided');
    }
}
