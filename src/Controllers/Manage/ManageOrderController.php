<?php

namespace Controllers\Manage
{

    use Utils\JWTUtils;

    class ManageOrderController
    {
        function __construct()
        {
            JWTUtils::isAuthorized(true);
        }
    }
}

