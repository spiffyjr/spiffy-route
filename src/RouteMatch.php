<?php

namespace Spiffy\Route;

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
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->params[$key] = $value;
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
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return \Spiffy\Route\Route
     */
    public function getRoute()
    {
        return $this->route;
    }
}
