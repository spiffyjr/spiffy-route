<?php

namespace Spiffy\Router;

class RouteFactory
{
    /**
     * @param string $name
     * @param string $path
     * @return Route
     */
    public function create($name, $path)
    {
        return new Route($name, $path);
    }
}
