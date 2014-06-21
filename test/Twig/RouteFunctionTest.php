<?php

namespace Spiffy\Route\Twig;

use Spiffy\Route\Router;

/**
 * @coversDefaultClass \Spiffy\Route\Twig\RouteFunction
 */
class RouteFunctionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__invoke
     */
    public function testInvoke()
    {
        $router = new Router();
        $router->add('foo', '/foo');


        $f = new RouteFunction($router, 'foo');
        $this->assertSame($router->assemble('foo'), $f('foo'));
    }
}
