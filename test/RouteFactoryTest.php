<?php

namespace Spiffy\Router;

/**
 * @coversDefaultClass Spiffy\Router\RouteFactory
 */
class RouterFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::create
     */
    public function testCreate()
    {
        $factory = new RouteFactory();
        $route = $factory->create('foo', '/foo');
        $this->assertInstanceOf('Spiffy\Router\Route', $route);
    }
}