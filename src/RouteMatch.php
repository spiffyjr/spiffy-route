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
     * @param string[] $params
     */
    public function __construct(Route $route, array $params = [])
    {
        $this->route = $route;
        $this->params = $params;
    }

    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->params[$key]) ? $this->params[$key] : $default;
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
