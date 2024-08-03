<?php
    $request = $_SERVER['REQUEST_URI'];

    switch ($request) {
        case '/' :
        case '' :
            require SRC . 'Controllers/Home/HomeController.php';
            $controller = new HomeController();
            $controller->index();
            break;
        default:
            http_response_code(404);
            echo 'Page not found';
            break;
    }
?>