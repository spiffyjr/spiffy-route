<?php

namespace Spiffy\Router\Exception;

class RouteDoesNotExistException extends \InvalidArgumentException
{
    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf(
            'The route with name "%s" does not exist',
            $name
        ));
    }
}
