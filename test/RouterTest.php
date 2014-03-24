<?php

namespace Spiffy\Route;

/**
 * @coversDefaultClass \Spiffy\Route\Router
 */
class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::add, ::getRoutes
     */
    public function testAddingRoutes()
    {
        $factory = new RouteFactory();

        $route = $factory->create('foo', '/foo');
        $route2 = $factory->create('bar', '/bar');

        $router = new Router();
        $router->add('foo', '/foo');
        $router->add('bar', '/bar');

        $routes = $router->getRoutes();
        $this->assertInstanceOf('ArrayObject', $routes);
        $this->assertArrayHasKey('foo', $routes);
        $this->assertArrayHasKey('bar', $routes);
        $this->assertEquals($route, $router->getRoutes()['foo']);
        $this->assertEquals($route2, $router->getRoutes()['bar']);
    }

    /**
     * @covers ::add, \Spiffy\Route\Exception\RouteExistsException::__construct
     * @expectedException \Spiffy\Route\Exception\RouteExistsException
     * @expectedExceptionMessage The route with name "foo" already exists
     */
    public function testAddingSameRouteNameThrowsException()
    {
        $router = new Router();
        $router->add('foo', '/foo');
        $router->add('foo', '/foo2');
    }

    /**
     * @covers ::add
     */
    public function testAddingRoutesWithNoName()
    {
        $router = new Router();
        $router->add(null, '/foo');
        $router->add(null, '/foo/bar');
        $router->add('foo', '/foo');

        $routes = $router->getRoutes();
        $this->assertCount(3, $routes);
        $this->assertArrayHasKey(0, $routes);
        $this->assertArrayHasKey(1, $routes);
        $this->assertArrayHasKey('foo', $routes);
    }

    /**
     * @covers ::match
     */
    public function testMatchingRoutes()
    {
        $router = new Router();
        $router->add('foo', '/foo');
        $router->add(null, '/bar');

        $this->assertInstanceOf('Spiffy\Route\RouteMatch', $router->match('/bar'));
        $this->assertInstanceOf('Spiffy\Route\RouteMatch', $router->match('/foo'));
        $this->assertNull($router->match('/does/not/exist'));
    }

    /**
     * @covers ::assemble, \Spiffy\Route\Exception\RouteDoesNotExistException::__construct
     * @expectedException \Spiffy\Route\Exception\RouteDoesNotExistException
     * @expectedExceptionMessage The route with name "foo" does not exist
     */
    public function testAssembleThrowsExceptionOnInvalidRouteName()
    {
        $router = new Router();
        $router->assemble('foo');
    }

    /**
     * @covers ::assemble
     */
    public function testAssemblingRoutes()
    {
        $router = new Router();
        $router->add('foo', '/foo');
        $this->assertSame('/foo', $router->assemble('foo'));
    }
}
