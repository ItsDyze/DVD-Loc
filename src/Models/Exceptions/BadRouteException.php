<?php

namespace Models\Exceptions
{

    class BadRouteException extends RouteException
    {
        function __construct($controllerName)
        {
            parent::__construct("Impossible route accessed $controllerName.");
        }
    }
}

