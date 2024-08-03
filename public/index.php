<?php
    define( "SRC" , dirname( dirname( __FILE__ ) ) . "\src\\" );
    define( "ASSETS" , dirname( __FILE__ ) . "\assets\\" );
    
    include "./index.template.php";
    require_once SRC .  "Middlewares/Routing.php";
?>

