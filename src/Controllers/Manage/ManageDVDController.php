<?php

namespace Controllers\Manage
{

    use Controllers\BaseController;
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

    class ManageDVDController extends BaseController
    {

        public function get(int $id = null): void
        {
            if($id === null)
            {
                $this->getAll();
            }
            else
            {
                $this->getById($id);
            }
        }

        public function getAll():void
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

            $controller = new ManageDVDListView($viewModel);
            $controller->render();
        }

        private function getById($id): void
        {
            $viewModel = new ManageDVDDetailViewModel();
            $service = DVDService::getInstance();

            $viewModel->DVD = $service->getDVDById($id);

            $controller = new ManageDVDDetailView($viewModel);
            $controller->render();
        }
    }
}

