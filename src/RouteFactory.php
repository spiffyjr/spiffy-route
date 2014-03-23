<?php

namespace Spiffy\Router;

class RouteFactory
{
    /**
     * @param string $name
     * @param string $path
     * @param array $spec
     * @return Route
     */
    public function create($name, $path, array $spec = [])
    {
        return new Route($name, $path);
    }
}
