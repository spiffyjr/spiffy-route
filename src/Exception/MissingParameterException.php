<?php

namespace Spiffy\Router\Exception;

class MissingParameterException extends \InvalidArgumentException
{
    /**
     * @param string $name
     * @param string $param
     */
    public function __construct($name, $param)
    {
        parent::__construct(sprintf(
            'Cannot assemble route "%s": missing required parameter "%s"',
            $name,
            $param
        ));
    }
}
