<?php namespace Controllers\Auth; ?>
<?php

    $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if(empty($requestedController) || $requestedController[1] != "Auth")
    {
        require SRC . 'Controllers/Home/HomeController.php';
        $controller = new HomeController();
        $controller->Index();
    }

    require_once SRC . 'Controllers/Auth/AuthController.php';
    $controller = new AuthController();

    switch ($requestedController[2]) {
        case '/' :
        case '' :
        case 'Login' :
            $controller->Index();
            break;
        case 'Register' :
            $controller->Register();
            break;
        default:
            http_response_code(404);
            echo 'Page not found';
            break;
    }
?>