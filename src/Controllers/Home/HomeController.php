<?php
    class HomeController {
        public function index() {
            $title = "Home Page";
            $view = SRC . "Views/Home/Home.php";
            include SRC . 'Views/Layout/Layout.php';
        }
    }
?>