<?php
namespace Controllers\Error
{

    use Controllers\Home\HomeController;
    use Models\Exceptions\BadRouteException;

    class ErrorRouter
    {
        function __construct()
        {

        }

        /**
         * @throws BadRouteException
         */
        public function route(): void
        {
            $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if(empty($requestedController) || strtolower($requestedController[1]) != "error")
            {
                throw new BadRouteException("Error");
            }

            $controller = new ErrorController();
            $controller->handle();
        }
    }
}

