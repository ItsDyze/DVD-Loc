<?php
namespace Controllers\Home
{

    use Controllers\BaseController;
    use Models\QueryModel\DVDQueryModel;
    use Models\QueryModel\HomeQueryModel;
    use Models\ViewModels\HomeViewModel;
    use Services\DVDService;
    use Views\Home\HomeView;

    class HomeController extends BaseController {
        public function get(): void
        {
            $data = new HomeViewModel();
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

            // override to prevent customers to see not-in-offer DVDs
            $queryModel->IsOffered = 1;

            $data->Query = $queryModel;
            $data->FilteredCount = $service->getCount($queryModel);
            $data->DVDs = $service->getAll($queryModel);
            $data->TotalPages = ceil($data->FilteredCount / $queryModel->Limit);
            $data->CurrentPage = ($queryModel->Offset / $queryModel->Limit) + 1;

            $view = new HomeView($data);
            $view->render();
        }
    }
}