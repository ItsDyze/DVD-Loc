<?php
namespace Controllers\Home
{

    use Controllers\BaseController;
    use Models\ViewModels\HomeViewModel;
    use Views\Home\HomeView;

    class HomeController extends BaseController {
        public function get(): void
        {
            $data = new HomeViewModel();
            $view = new HomeView($data);
            $view->render();
        }
    }
}