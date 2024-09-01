<?php

namespace Controllers\Manage
{

    use Controllers\BaseController;
    use Models\QueryModel\DVDQueryModel;
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
            $service = DVDService::getInstance();
            $queryModel = new DVDQueryModel();
            $queryModel->IsOffered=true;
            $viewModel->DVDCount = $service->getCount();
            $viewModel->OfferedDVDCount = $service->getCount($queryModel);
            $view = new DashboardView($viewModel);
            $view->render();
        }
    }
}