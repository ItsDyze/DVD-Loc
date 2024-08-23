<?php

namespace Controllers\Manage
{

    use Controllers\BaseController;
    use Exception;
    use Models\DVDModel;
    use Models\Exceptions\BadRouteException;
    use Models\Exceptions\RouteNotFoundException;
    use Models\QueryModel\DVDQueryModel;
    use Models\ViewModels\ManageDVDDetailViewModel;
    use Models\ViewModels\ManageDVDDetailViewStateEnum;
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

        private function getAll():void
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
            $viewModel->FilteredCount = $service->getCount($queryModel);
            $viewModel->DVDs = $service->getAll($queryModel);
            $viewModel->TotalPages = ceil($viewModel->FilteredCount / $queryModel->Limit);
            $viewModel->CurrentPage = ($queryModel->Offset / $queryModel->Limit) + 1;

            $controller = new ManageDVDListView($viewModel);
            $controller->render();
        }

        private function getById($id): void
        {
            $viewModel = new ManageDVDDetailViewModel();
            $service = DVDService::getInstance();

            $viewModel->DVD = $service->getById($id);
            $viewModel->state = ManageDVDDetailViewStateEnum::Update;

            $controller = new ManageDVDDetailView($viewModel);
            $controller->render();
        }

        public function put($id): void
        {
            if($id === null)
            {
                http_response_code(502);
            }

            $model = new DVDModel();
            $service = DVDService::getInstance();

            $model->Id = $id;
            $model->Title = $_POST["Title"];
            $model->LocalTitle = $_POST["LocalTitle"];
            $model->Synopsis = $_POST["Synopsis"];
            $model->Notation = $_POST["Notation"];

            $service->update($model);

            header("Location: /manage/dvd/$id");
            die();
        }
    }
}

