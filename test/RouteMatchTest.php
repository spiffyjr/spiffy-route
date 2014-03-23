<?php

namespace Spiffy\Router;

/**
 * @coversDefaultClass Spiffy\Router\RouteMatch
 */
class RouterMatchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::getRoute
     */
    public function testGetRoute()
    {
        $route = new Route('foo', '/foo');
        $match = new RouteMatch($route);

        $this->assertSame($route, $match->getRoute());
    }

    /**
     * @covers ::get
     */
    public function testGet()
    {
        $route = new Route('foo', '/foo');
        $match = new RouteMatch($route, ['id' => 1]);

        $this->assertSame(1, $match->get('id'));
        $this->assertNull($match->get('doesnotexist'));
    }

    /**
     * @covers ::getParams
     */
    public function testGetParams()
    {
        $params = ['id' => 1, 'foo' => 'bar'];
        $route = new Route('foo', '/foo');
        $match = new RouteMatch($route, $params);

        $this->assertSame($params, $match->getParams());
    }
}