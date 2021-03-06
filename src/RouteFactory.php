<?php

namespace Spiffy\Route;

class RouteFactory
{
    /**
     * @param string $name
     * @param string $path
     * @param array $options
     * @return Route
     */
    public function create($name, $path, array $options = [])
    {
        $route = new Route($name, $path);

        if (isset($options['defaults'])) {
            $route->setDefaults($options['defaults']);
        }

        if (isset($options['methods'])) {
            $route->setMethods($options['methods']);
        }

        return $route;
    }
}
