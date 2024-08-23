<?php

namespace Controllers\Manage
{

    use Controllers\BaseController;
    use Models\QueryModel\DVDQueryModel;
    use Models\ViewModels\DashboardViewModel;
    use Services\DVDService;
    use Views\Manage\Dashboard\DashboardView;

    class ManageDashboardController extends BaseController
    {
        public function get(): void
        {
            $viewModel = new DashboardViewModel();
            $service = DVDService::getInstance();
            $queryModel = new DVDQueryModel();
            $queryModel->IsOffered=true;
            $viewModel->DVDCount = $service->getDVDCount();
            $viewModel->OfferedDVDCount = $service->getDVDCount($queryModel);
            $view = new DashboardView($viewModel);
            $view->render();
        }
    }
}