<?php

namespace Models\ViewModels
{

    use Interfaces\IViewModel;
    use Models\DVDModel;

    class ManageDVDDetailViewModel implements IViewModel
    {
        public array $Types;
        public array $Genres;
        public DVDModel $DVD;
        public ManageDVDDetailViewStateEnum $State;
    }
}

