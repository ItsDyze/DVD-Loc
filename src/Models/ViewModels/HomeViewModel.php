<?php

namespace Models\ViewModels
{

    use Interfaces\IViewModel;
    use Models\QueryModel\HomeQueryModel;

    class HomeViewModel implements IViewModel
    {

        public array $DVDs;
        public int $FilteredCount;
        public HomeQueryModel $Query;

        public array $DVDCollections;
    }
}