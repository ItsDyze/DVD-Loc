<?php

namespace Models\Exceptions;

use Exception;

class RouteException extends Exception
{
    function __construct($message)
    {
        parent::__construct($message . "Route used was " . $_REQUEST['REQUEST_URI']);
    }

}