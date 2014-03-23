# SpiffyRouter

[![Build Status](https://travis-ci.org/spiffyjr/spiffy-router.svg)](https://travis-ci.org/spiffyjr/spiffy-router)
[![Code Coverage](https://scrutinizer-ci.com/g/spiffyjr/spiffy-router/badges/coverage.png?s=ef1ff5a501ca851edf629fbf1fe85f66b7616672)](https://scrutinizer-ci.com/g/spiffyjr/spiffy-router/)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spiffyjr/spiffy-router/badges/quality-score.png?s=c538c960c0d883f379b700eecdee865d08a532e3)](https://scrutinizer-ci.com/g/spiffyjr/spiffy-router/)

## Installation
Spiffy\Router can be installed using composer which will setup any autoloading for you.

`composer require spiffy/spiffy-router`

Additionally, you can download or clone the repository and setup your own autoloading.

## Adding routes

```php
<?php

use Spiffy\Router\Router;

$router = new Router();

// Basic route with name
$router->add('foo', '/foo');
// matches /foo

// Basic route with no name
$router->add(null, '/foo');
// matches /foo

// Route with tokens
$router->add('foo', '/foo/{name}');
// matches /foo/bar

// Router with optional tokens
$router->add('foo', '/foo{/name?}');
// matches /foo or /foo/bar

// Router with tokens and constraints
$router->add('foo', '/foo/{id:\d+}-{slug}');
// matches /foo/1-bar but not /foo/baz-bar

// The kitchen sink
$router->add('foo', '/foo/{id:\d+}{-slug?:[a-zA-Z-_]+}');
// matches /foo/1, /foo/1-bar, /foo/1-BaR
// does not match /foo/1-2
```

## Assembling named routes to url's

```php
<?php

use Spiffy\Router\Router;

$router = new Router();
$router->add('foo', '/foo');

// outputs '/foo'
echo $router->assemble('foo');

$router->add('foo', '/foo/{id:\d+}{-slug?:[a-zA-Z-_]+}');

// outputs '/foo/1'
echo $router->assemble('foo', ['id' => 1]);

// outputs '/foo/1-bar'
echo $router->assemble('foo', ['id' => 1, 'slug' => 'bar']);
```