<?php

namespace Controllers\Manage
{

    use Controllers\Home\HomeController;
    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteNotFoundException;

    class ManageRouter
    {

        /**
         * @throws BadRouteException
         * @throws RouteNotFoundException
         */
        public function route(): void
        {
            $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if(empty($requestedController) || strtolower($requestedController[1]) != "manage")
            {
                throw new BadRouteException("Manage");
            }

            if(!isset($requestedController[2]))
            {
                $controller = new ManageDashboardController();
                $controller->handle();
                exit;
            }

            switch (strtolower($requestedController[2])) {
                case '/' :
                case 'dashboard' :
                    $controller = new ManageDashboardController();
                    $controller->handle();
                    break;
                default:
                    throw new RouteNotFoundException("Manage");
                    break;
            }
        }
    }
}

