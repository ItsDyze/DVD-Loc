<?php

namespace Models\Exceptions;

use Exception;

class RouteNotFoundException extends RouteException
{
    function __construct($controllerName)
    {
        parent::__construct("Route not found for $controllerName.");
    }

}