<?php
namespace Middlewares
{

    use Controllers\Auth\AuthController;
    use Controllers\Auth\AuthRouter;
    use Controllers\Auth\LoginController;
    use Controllers\Auth\LogoutController;
    use Controllers\Auth\RegisterController;
    use Controllers\DVD\DVDController;
    use Controllers\Error\ErrorController;
    use Controllers\Error\ErrorRouter;
    use Controllers\Home\HomeController;
    use Controllers\Manage\ManageDashboardController;
    use Controllers\Manage\ManageDVDController;
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
            $route = strtolower(rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/\\'));
            $verb = strtolower($_SERVER['REQUEST_METHOD']);
            if($verb == "post" && isset($_POST['_METHOD']))
            {
                $verb = strtolower($_POST['_METHOD']);
            }
            $fragments = explode('/', $route);
            $routeHasParam = is_numeric($fragments[count($fragments) - 1]);
            $param = null;
            if($routeHasParam) {
                $param = $fragments[count($fragments) - 1];
                $route = rtrim($route, '/\\' . $param);
            }

            if($route == "") { $route = "/home"; }

            $routeRegistry = array(
                "/home" => function() {
                    return new HomeController();
                },
                "/auth/login" => function() {
                    return new LoginController();
                },
                "/auth/logout" => function() {
                    return new LogoutController();
                },
                "/auth/register" => function() {
                    return new RegisterController();
                },
                "/error" => function() {
                    return new ErrorController();
                },
                "/manage" => function() {
                    return new ManageDashboardController();
                },
                "/manage/dashboard" => function() {
                    return new ManageDashboardController();
                },
                "/manage/dvd" => function() {
                    return new ManageDVDController();
                },
                "/dvd" => function() {
                    return new DVDController();
                }
            );

            if(!is_callable($routeRegistry[$route]))
            {
                http_response_code(404);
            }
            else
            {
                $controller = $routeRegistry[$route]();
                $param === null ? $controller->$verb() : $controller->$verb($param);
            }
        }
    }
}