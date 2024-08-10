<?php

# Globals definitions
use Middlewares\Routing;

define( "SRC" , dirname(__FILE__, 2) . "\src\\" );
define( "ASSETS" , dirname( __FILE__ ) . "\assets\\" );
define( "IS_DEV" , strtolower($_SERVER['HTTP_HOST']) == "c218");

#Autoload
spl_autoload_register(function ($class) {
    $file = SRC . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

# Default view
include "./index.template.php";

# Call the router
$router = new Routing();
$router->route();


