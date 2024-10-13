<?php

namespace Controllers\Manage
{

    use Controllers\BaseController;
    use Models\DVDModel;
    use Models\QueryModel\ManageDVDQueryModel;
    use Models\ViewModels\ManageDVDDetailViewModel;
    use Models\ViewModels\ManageDVDDetailViewStateEnum;
    use Models\ViewModels\ManageDVDListViewModel;
    use Services\DVDService;
    use Services\GenreService;
    use Services\TypeService;
    use Utils\JWTUtils;
    use Views\Manage\DVD\Detail\ManageDVDDetailView;
    use Views\Manage\DVD\List\ManageDVDListView;

    class ManageDVDController extends BaseController
    {

        function __construct()
        {
            JWTUtils::isAuthorized(true);
        }

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
            $service = new DVDService();

            $queryModel = new ManageDVDQueryModel();
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
            $viewModel->FilteredCount = $service->getCount($queryModel->IsOffered, $queryModel);
            $viewModel->DVDs = $service->getAll($queryModel, $queryModel->IsOffered);
            $viewModel->TotalPages = ceil($viewModel->FilteredCount / $queryModel->Limit);
            $viewModel->CurrentPage = ($queryModel->Offset / $queryModel->Limit) + 1;

            $controller = new ManageDVDListView($viewModel);
            $controller->render();
        }

        private function getById($id): void
        {
            $viewModel = new ManageDVDDetailViewModel();
            $service = new DVDService();

            $genreService = new GenreService();
            $typeService = new TypeService();

            $viewModel->Genres  = $genreService->getAll();
            $viewModel->Types  = $typeService->getAll();

            if($id === -1)
            {
                $viewModel->State = ManageDVDDetailViewStateEnum::Create;
                $model = new DVDModel();
                $model->Title = "";
                $model->LocalTitle = "";
                $model->Synopsis = "";
                $model->Notation = 0;
                $model->Certification = "";
                $model->Note = "";
                $model->IsOffered = true;
                $model->Quantity = 0;
                $model->Price = 0;
                $model->Year = 0;
                $model->TypeId = null;
                $model->Image = null;
                $model->GenreId = null;

                $viewModel->DVD = $model;

            }
            else
            {
                $viewModel->DVD = $service->getById($id);
                $viewModel->State = ManageDVDDetailViewStateEnum::Update;
            }

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
            $service = new DVDService();

            $model->Id = $id;
            $this->postToDvdModel($model);

            $service->update($model);

            header("Location: /manage/dvd/$id");
            die();
        }

        public function post(): void
        {

            $model = new DVDModel();
            $service = new DVDService();

            $this->postToDvdModel($model);
            //$model->Image = $_POST["Image"];

            $newId = $service->insert($model);

            header("Location: /manage/dvd/$newId");
            die();
        }

        public function delete($id): void
        {
            $service = new DVDService();

            $newId = $service->delete($id);

            header("Location: /manage/dvd");
            die();
        }

        private function postToDvdModel(DVDModel $model)
        {
            $model->Title = $_POST["Title"];
            $model->LocalTitle = $_POST["LocalTitle"];
            $model->Synopsis = $_POST["Synopsis"];
            $model->Notation = $_POST["Notation"];
            $model->Certification = $_POST["Certification"];
            $model->Note = $_POST["Note"];
            $model->IsOffered = $_POST["IsOffered"] ?? false;
            $model->Quantity = $_POST["Quantity"];
            $model->Price = $_POST["Price"];
            $model->Year = $_POST["Year"];
            $model->TypeId = isset($_POST["TypeId"]) ? intval($_POST["TypeId"]) : null;
            $model->GenreId = isset($_POST["GenreId"]) ? intval($_POST["GenreId"]) : null;
            $model->Image = $_POST["Image"];
        }
    }
}

