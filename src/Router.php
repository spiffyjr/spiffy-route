<?php

namespace Spiffy\Route;

class Router
{
    /**
     * @var \ArrayObject
     */
    protected $routes;

    /**
     * @var RouteFactory
     */
    protected $routeFactory;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->routeFactory = new RouteFactory();
        $this->routes = new \ArrayObject();
    }

    /**
     * @return \ArrayObject
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @param string|null $name
     * @param string $path
     * @param array $options
     * @throws Exception\RouteExistsException
     * @return \Spiffy\Route\Route
     */
    public function add($name, $path, array $options = [])
    {
        if (null !== $name && $this->routes->offsetExists($name)) {
            throw new Exception\RouteExistsException($name);
        }

        $route = $this->routeFactory->create($name, $path, $options);
        if (null === $name) {
            $this->routes[] = $route;
            return $route;
        }

        $this->routes[$name] = $route;
        return $route;
    }

    /**
     * @param string $uri
     * @param array $server
     * @return RouteMatch|null
     */
    public function match($uri, array $server = null)
    {
        /** @var Route $route */
        foreach ($this->routes as $route) {
            if ($match = $route->match($uri, $server)) {
                return $match;
            }
        }
        return null;
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     * @throws Exception\RouteDoesNotExistException
     */
    public function assemble($name, array $params = [])
    {
        if (!$this->routes->offsetExists($name)) {
            throw new Exception\RouteDoesNotExistException($name);
        }
        
        /** @var Route $route */
        $route = $this->routes[$name];
        return $route->assemble($params);
    }
}
