<?php

namespace Controllers\Manage
{

    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteNotFoundException;
    use Models\QueryModel\DVDQueryModel;
    use Models\ViewModels\DashboardViewModel;
    use Services\DVDService;
    use Views\Manage\Dashboard\DashboardView;

    class ManageDashboardController
    {
        public function index(): void
        {
            $viewModel = new DashboardViewModel();
            $service = DVDService::getInstance();
            $queryModel = new DVDQueryModel();
            $queryModel->IsOffered=true;
            $viewModel->DVDCount = $service->getDVDCount();
            $viewModel->OfferedDVDCount = $service->getDVDCount($queryModel);
            new DashboardView($viewModel);
        }


        /**
         * @throws BadRouteException
         * @throws RouteNotFoundException
         */
        public function handle(): void
        {
            $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if(empty($requestedController))
            {
                throw new BadRouteException("Manage/Dashboard");
            }

            if(!isset($requestedController[3]))
            {
                $this->index();
                exit;
            }

            switch (strtolower($requestedController[3])) {
                case '/' :
                    $this->index();
                    break;
                default:
                    throw new RouteNotFoundException("Manage/Dashboard");
            }
        }
    }
}