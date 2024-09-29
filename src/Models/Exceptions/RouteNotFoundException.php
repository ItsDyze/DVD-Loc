<?php

namespace Models\Exceptions;

class RouteNotFoundException extends RouteException
{
    function __construct($controllerName)
    {
        parent::__construct("Route not found for $controllerName.");
    }

}