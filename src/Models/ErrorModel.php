<?php

namespace Models;

use Exception;
use Interfaces\IViewModel;

class ErrorModel implements IViewModel
{
    public Exception $exception;
}