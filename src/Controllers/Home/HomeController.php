<?php
namespace Controllers\Home
{

    use Models\ViewModels\HomeViewModel;
    use Views\Home\HomeView;

    class HomeController {
        public function index(): void
        {
            if($_SERVER['REQUEST_METHOD'] !== 'GET')
            {
                http_response_code(405);
            }
            $data = new HomeViewModel();
            new HomeView($data);
        }
    }
}