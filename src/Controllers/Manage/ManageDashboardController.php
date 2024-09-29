<?php

namespace Controllers\Manage
{

    use Controllers\BaseController;
    use Models\ViewModels\DashboardViewModel;
    use Services\DVDService;
    use Utils\JWTUtils;
    use Views\Manage\Dashboard\DashboardView;

    class ManageDashboardController extends BaseController
    {
        function __construct()
        {
            JWTUtils::isAuthorized(true);
        }

        public function get(): void
        {
            $viewModel = new DashboardViewModel();
            $service = new DVDService();
            $viewModel->DVDCount = $service->getCount();
            $viewModel->OfferedDVDCount = $service->getCount(true);
            $view = new DashboardView($viewModel);
            $view->render();
        }
    }
}