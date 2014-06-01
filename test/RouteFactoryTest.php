<?php

namespace Spiffy\Route;

/**
 * @coversDefaultClass Spiffy\Route\RouteFactory
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
        $this->assertInstanceOf('Spiffy\Route\Route', $route);
    }

    /**
     * @covers ::create
     */
    public function testSettingMethods()
    {
        $methods = ['get', 'post'];

        $factory = new RouteFactory();
        $route = $factory->create('foo', '/foo', ['methods' => $methods]);

        $this->assertInstanceOf('Spiffy\Route\Route', $route);
        $this->assertSame($methods, $route->getMethods());
    }

    /**
     * @covers ::create
     */
    public function testSettingDefaults()
    {
        $defaults = ['controller' => 'foo-controller'];

        $factory = new RouteFactory();
        $route = $factory->create('foo', '/foo', ['defaults' => $defaults]);

        $this->assertInstanceOf('Spiffy\Route\Route', $route);
        $this->assertSame($defaults, $route->getDefaults());
    }
}
