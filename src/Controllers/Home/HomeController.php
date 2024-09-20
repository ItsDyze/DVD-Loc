<?php
namespace Controllers\Home
{

    use Controllers\BaseController;
    use Models\CollectionTypeEnum;
    use Models\DVDCollection;
    use Models\QueryModel\HomeQueryModel;
    use Models\ViewModels\HomeViewModel;
    use Services\DVDService;
    use Views\Home\HomeView;

    class HomeController extends BaseController {
        public function get(): void
        {
            $data = new HomeViewModel();
            $service = DVDService::getInstance();

            $queryModel = new HomeQueryModel();
            if(!empty($_GET))
            {
                $queryModel->setFromQueryString($_GET);
            }
            else
            {
                header('Location: ' . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)."?".$queryModel->getQueryString(), true, 303);
                die();
            }

            $data->Query = $queryModel;
            $data->DVDs = $service->getAll($queryModel, true);
            $data->DVDCollections = [];
            $highlightCollection = new DVDCollection();
            $highlightCollection->Name = "En avant";
            $highlightCollection->CollectionType = CollectionTypeEnum::Highlight;
            $highlightCollection->DVDs = $service->getAll($queryModel, true);
            $data->DVDCollections[] = $highlightCollection;


            $view = new HomeView($data);
            $view->render();
        }
    }
}