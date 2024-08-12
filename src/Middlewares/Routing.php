<?php
namespace Middlewares
{
    use Controllers\Auth\AuthRouter;
    use Controllers\Error\ErrorController;
    use Controllers\Error\ErrorRouter;
    use Controllers\Home\HomeController;
    use Controllers\Manage\ManageRouter;
    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteException;
    use Models\Exceptions\RouteNotFoundException;

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

            try
            {
                switch (strtolower($requestedController[1])) {
                    case '/' :
                    case '' :
                    case 'home' :
                        $controller = new HomeController();
                        $controller->Index();
                        break;
                    case 'auth' :
                        $subRouter = new AuthRouter();
                        $subRouter->route();
                        break;
                    case 'manage' :
                        $subRouter = new ManageRouter();
                        $subRouter->route();
                        break;
                    case 'error' :
                        $subRouter = new ErrorRouter();
                        $subRouter->route();
                        break;
                    default:
                        http_response_code(404);
                        echo 'Page not found';
                        break;
                }
            }
            catch (RouteException $e)
            {
                $controller = new ErrorController();
                $controller->serverError($e);
            }
        }
    }
}