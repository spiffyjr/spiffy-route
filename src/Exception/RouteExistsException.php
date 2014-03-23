<?php

namespace Spiffy\Router\Exception;

class RouteExistsException extends \InvalidArgumentException
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf(
            'The route with name "%s" already exists',
            $name
        ));
    }
}
