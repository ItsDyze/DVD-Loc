<?php
namespace Middlewares
{
    use Controllers\Auth\AuthRouter;
    use Controllers\Home\HomeController;

    class Routing
    {
        function __construct()
        {

        }

        public function route(): void
        {
            $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if(empty($requestedController))
            {
                $controller = new HomeController();
                $controller->Index();
            }

            switch ($requestedController[1]) {
                case '/' :
                case '' :
                case 'Home' :
                    $controller = new HomeController();
                    $controller->Index();
                    break;
                case 'Auth' :
                    $subRouter = new AuthRouter();
                    $subRouter->route();
                    break;
                default:
                    http_response_code(404);
                    echo 'Page not found';
                    break;
            }
        }
    }
}