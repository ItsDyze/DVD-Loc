<?php
namespace Controllers\Auth
{

    use Controllers\Error\ErrorController;
    use Controllers\Home\HomeController;
    use Exception;
    use HttpRequestException;
    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteNotFoundException;

    class AuthRouter
    {
        function __construct()
        {

        }

        /**
         * @throws BadRouteException on routes not matching the required arguments
         * @throws RouteNotFoundException on routes not found
         */
        public function route(): void
        {
            $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if(empty($requestedController) || strtolower($requestedController[1]) != "auth")
            {
                throw new BadRouteException("Auth");
            }

            $controller = new AuthController();
            $controller->handle();
        }
    }
}

