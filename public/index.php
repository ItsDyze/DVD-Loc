<?php
    define( "SRC" , dirname( dirname( __FILE__ ) ) . "\src\\" );
    define( "ASSETS" , dirname( __FILE__ ) . "\assets\\" );
    define( "IS_DEV" , in_array(strtolower($_SERVER['HTTP_HOST']), ["c218"]) );

    
    include "./index.template.php";
    require_once SRC .  "Middlewares/Routing.php";
?>

