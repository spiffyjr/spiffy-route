<?php

namespace Spiffy\Router;

class RouteMatch
{
    /**
     * @var Route
     */
    protected $route;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param Route $route
     * @param array $params
     */
    public function __construct(Route $route, array $params = [])
    {
        $this->route = $route;
        $this->params = $params;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->params[$key]) ? $this->params[$key] : null;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return \Spiffy\Router\Route
     */
    public function getRoute()
    {
        return $this->route;
    }
}
