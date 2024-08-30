<?php

namespace Models\ViewModels
{

    use Interfaces\IViewModel;
    use Models\QueryModel\DVDQueryModel;

    class HomeViewModel implements IViewModel
    {

        public array $DVDs;
        public int $FilteredCount;
        public DVDQueryModel $Query;
        public int $TotalPages;
        public int $CurrentPage;
    }
}