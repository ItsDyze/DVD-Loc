<?php

namespace Controllers\Manage
{

    use Models\DVDModel;
    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteNotFoundException;
    use Models\QueryModel\DVDQueryModel;
    use Models\ViewModels\ManageDVDDetailViewModel;
    use Models\ViewModels\ManageDVDListViewModel;
    use Services\DVDService;
    use Utils\PHPUtils;
    use Views\Manage\DVD\Detail\ManageDVDDetailView;
    use Views\Manage\DVD\List\ManageDVDListView;

    class ManageDVDController
    {
        public function index(int $dvd = -1): void
        {
            if ($dvd > -1)
            {
                $this->indexDetail($dvd);
            }
            else
            {
                $this->indexList();
            }
        }

        private function indexList()
        {
            $viewModel = new ManageDVDListViewModel();
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
            new ManageDVDListView($viewModel);
        }

        private function indexDetail($dvd)
        {
            $viewModel = new ManageDVDDetailViewModel();
            $service = DVDService::getInstance();

            $viewModel->DVD = PHPUtils::objectToObject($service->getDVDById($dvd), DVDModel::class);

            new ManageDVDDetailView($viewModel);
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

            if(isset($requestedController[3]) && is_int(intval($requestedController[3])))
            {
                $this->index(intval($requestedController[3]));
            }
            else
            {
                 $this->index();
            }
        }
    }
}

