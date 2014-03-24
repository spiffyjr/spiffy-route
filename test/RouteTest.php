<?php

namespace Spiffy\Route;

/**
 * @coversDefaultClass Spiffy\Route\Route
 */
class RouteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::getName()
     */
    public function testGetName()
    {
        $name = 'foo';
        $route = new Route($name, '/foo');
        $this->assertSame($name, $route->getName());
    }

    /**
     * @covers ::getPath()
     */
    public function testGetPath()
    {
        $path = '/foo';
        $route = new Route('foo', $path);
        $this->assertSame($path, $route->getPath());
    }

    /**
     * @covers ::init, ::match
     */
    public function testNoMatch()
    {
        $route = new Route('foo', '/bar');
        $this->assertFalse($route->match('/foo'));
    }

    /**
     * @covers ::init, ::match
     */
    public function testNoMatchForRegexEndOfLine()
    {
        $route = new Route('foo', '/foobar');
        $this->assertFalse($route->match('/foo'));
    }

    /**
     * @covers ::init, ::match
     */
    public function testMatchReturnsRouteMatch()
    {
        $route = new Route('foo', '/foo/{id}');
        $match = $route->match('/foo/bar');

        $this->assertInstanceOf('Spiffy\Route\RouteMatch', $match);
        $this->assertSame($route, $match->getRoute());
        $this->assertSame('bar', $match->get('id'));
    }

    /**
     * @covers ::init, ::match
     */
    public function testMatchWithConstraints()
    {
        $route = new Route('foo', '/foo/{id:\d+}');
        $this->assertFalse($route->match('/foo/bar'));

        $match = $route->match('/foo/1234');
        $this->assertInstanceOf('Spiffy\Route\RouteMatch', $match);
        $this->assertSame($route, $match->getRoute());
        $this->assertSame('1234', $match->get('id'));
    }

    /**
     * @covers ::init, ::match
     */
    public function testMatchWithOptionalTokens()
    {
        $route = new Route('foo', '/foo/{id:\d+}{-slug?}');

        $match = $route->match('/foo/1');
        $this->assertInstanceOf('Spiffy\Route\RouteMatch', $match);
        $this->assertSame('1', $match->get('id'));
        $this->assertEmpty($match->get('slug'));

        $match = $route->match('/foo/1-testing');
        $this->assertInstanceOf('Spiffy\Route\RouteMatch', $match);
        $this->assertSame('1', $match->get('id'));
        $this->assertSame('testing', $match->get('slug'));
    }

    /**
     * @covers ::assemble, ::init, \Spiffy\Route\Exception\MissingParameterException::__construct
     * @expectedException \Spiffy\Route\Exception\MissingParameterException
     * @expectedExceptionMessage Cannot assemble route "foo": missing required parameter "id"
     */
    public function testAssembleThrowsExceptionOnMissingRequiredParameter()
    {
        $route = new Route('foo', '/foo/{id}');
        $route->assemble();
    }

    /**
     * @covers ::assemble
     */
    public function testAssembleWithNoTokens()
    {
        $route = new Route('foo', '/foo');
        $this->assertSame('/foo', $route->assemble());
    }

    /**
     * @covers ::assemble
     */
    public function testAssemble()
    {
        $route = new Route('foo', '/foo/{name}');
        $this->assertSame('/foo/bar', $route->assemble(['name' => 'bar']));
    }

    /**
     * @covers ::assemble, ::init
     */
    public function testAssembleWithOptionalParams()
    {
        $route = new Route('foo', '/foo/{id?}');
        $this->assertSame('/foo/', $route->assemble());

        $route = new Route('foo', '/foo{/id?}');
        $this->assertSame('/foo', $route->assemble());

        $route = new Route('foo', '/foo/{id:\d+}{-slug?}');
        $this->assertSame('/foo/1', $route->assemble(['id' => 1]));
        $this->assertSame('/foo/1-test', $route->assemble(['id' => 1, 'slug' => 'test']));
    }

    /**
     * @cowers ::match, ::init, ::setDefaults
     */
    public function testMatchWithDefaults()
    {
        $route = new Route('foo', '/foo');
        $route->setDefaults(['controller' => 'foo']);

        $match = $route->match('/foo');
        $this->assertSame('foo', $match->get('controller'));
    }

    /**
     * @covers ::setDefaults, ::getDefaults
     */
    public function testRouteDefaults()
    {
        $defaults = ['controller' => 'foo'];

        $route = new Route('foo', '/foo');
        $route->setDefaults($defaults);

        $this->assertSame($defaults, $route->getDefaults());
    }
}
