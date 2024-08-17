<?php

namespace Controllers\Manage
{

    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteNotFoundException;
    use Models\QueryModel\DVDQueryModel;
    use Models\ViewModels\ManageDVDViewModel;
    use Services\DVDService;
    use Views\Manage\DVD\ManageDVDView;

    class ManageDVDController
    {
        public function index()
        {
            $viewModel = new ManageDVDViewModel();
            $service = DVDService::getInstance();

            $queryModel = new DVDQueryModel();
            if(!empty($_GET))
            {
                $queryModel->setFromQueryString($_GET);
            }
            else
            {
                header('Location: ' . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)."?".$queryModel->getQueryString(), true, 303);
                die();
            }

            $viewModel->Query = $queryModel;
            $viewModel->FilteredCount = $service->getDVDCount($queryModel);
            $viewModel->DVDs = $service->getDVDs($queryModel);
            $viewModel->TotalPages = ceil($viewModel->FilteredCount / $queryModel->Limit);
            $viewModel->CurrentPage = ($queryModel->Offset / $queryModel->Limit) + 1;
            new ManageDVDView($viewModel);
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

