<?php
namespace Controllers\Home
{

    use Models\HomeViewModel;
    use Views\Home\HomeView;

    class HomeController {
        public function index(): void
        {
            $data = new HomeViewModel();
            new HomeView($data);
        }
    }
}