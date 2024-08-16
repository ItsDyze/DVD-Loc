<?php

namespace Models\ViewModels
{

    use Interfaces\IViewModel;
    use Models\QueryModel\DVDQueryModel;

    class DVDViewModel implements IViewModel
    {
        public array $DVDs;
        public int $FilteredCount;
        public DVDQueryModel $Query;
    }
}

