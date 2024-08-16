<?php

namespace Controllers\Manage
{

    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteNotFoundException;
    use Models\QueryModel\DVDQueryModel;
    use Models\ViewModels\DVDViewModel;
    use Services\DVDService;
    use Views\Manage\DVD\DVDView;

    class ManageDVDController
    {
        public function index()
        {
            $viewModel = new DVDViewModel();
            $service = DVDService::getInstance();
            $queryModel = new DVDQueryModel();
            $queryModel->IsOffered=true;
            $viewModel->Query = $queryModel;
            $viewModel->FilteredCount = $service->getDVDCount($queryModel);
            new DVDView($viewModel);
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
                throw new BadRouteException("Manage/DVD");
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
                    throw new RouteNotFoundException("Manage/DVD");
            }
        }
    }
}

