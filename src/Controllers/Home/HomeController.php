<?php namespace Controllers\Home; ?>
<?php

    class HomeController {
        public function Index() {
            $title = "Home Page";
            $view = SRC . "Views/Home/Home.php";
            include SRC . 'Views/Layout/Layout.php';
        }
    }
?>