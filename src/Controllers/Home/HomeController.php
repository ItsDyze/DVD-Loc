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
            $service = new DVDService();

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
            $highlightCollection->Order = 1;
            $highlightCollection->Name = "En avant";
            $highlightCollection->CollectionType = CollectionTypeEnum::Highlight;
            $highlightCollection->DVDs = $service->getHighlights(true);
            $data->DVDCollections[] = $highlightCollection;

            $mostPopularGenres = $service->getMostPopularGenres();

            if(!empty($mostPopularGenres))
            {
                $firstGenreCollection = new DVDCollection();
                $firstGenreCollection->Order = 10;
                $firstGenreCollection->Name = $mostPopularGenres[0]->Name;
                $firstGenreCollection->CollectionType = CollectionTypeEnum::Genre;
                $firstGenreCollection->DVDs = $service->getByGenre($mostPopularGenres[0]->Id);
                $data->DVDCollections[] = $firstGenreCollection;

                if(count($mostPopularGenres) > 1)
                {
                    $secondGenreCollection = new DVDCollection();
                    $secondGenreCollection->Order = 11;
                    $secondGenreCollection->Name = $mostPopularGenres[1]->Name;
                    $secondGenreCollection->CollectionType = CollectionTypeEnum::Genre;
                    $secondGenreCollection->DVDs = $service->getByGenre($mostPopularGenres[1]->Id);
                    $data->DVDCollections[] = $secondGenreCollection;
                }
            }


            $mostPopularTypes = $service->getMostPopularTypes();

            if(!empty($mostPopularTypes))
            {
                $firstTypeCollection = new DVDCollection();
                $firstTypeCollection->Order = 5;
                $firstTypeCollection->Name = $mostPopularTypes[0]->Name;
                $firstTypeCollection->CollectionType = CollectionTypeEnum::Type;
                $firstTypeCollection->DVDs = $service->getByType($mostPopularTypes[0]->Id);
                $data->DVDCollections[] = $firstTypeCollection;

                if(count($mostPopularTypes) > 1)
                {
                    $secondTypeCollection = new DVDCollection();
                    $secondTypeCollection->Order = 6;
                    $secondTypeCollection->Name = $mostPopularTypes[1]->Name;
                    $secondTypeCollection->CollectionType = CollectionTypeEnum::Type;
                    $secondTypeCollection->DVDs = $service->getByType($mostPopularTypes[1]->Id);
                    $data->DVDCollections[] = $secondTypeCollection;
                }
            }

            usort($data->DVDCollections, function($a, $b){ return $a->Order - $b->Order; });

            $view = new HomeView($data);
            $view->render();
        }
    }
}