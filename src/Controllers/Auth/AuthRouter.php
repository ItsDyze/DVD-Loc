<?php
namespace Controllers\Auth
{
    use Controllers\Home\HomeController;

    class AuthRouter
    {
        function __construct()
        {

        }

        public function route(): void
        {
            $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if(empty($requestedController) || strtolower($requestedController[1]) != "auth")
            {
                $controller = new HomeController();
                $controller->Index();
            }

            $controller = new AuthController();

            switch (strtolower($requestedController[2])) {
                case '/' :
                case '' :
                case 'login' :
                    $controller->index();
                    break;
                case 'register' :
                    $controller->register();
                    break;
                default:
                    http_response_code(404);
                    echo 'Page not found';
                    break;
            }
        }
    }
}

