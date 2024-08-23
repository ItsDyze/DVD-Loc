<?php

namespace Models\ViewModels
{

    use Interfaces\IViewModel;
    use Models\DVDModel;

    class ManageDVDDetailViewModel implements IViewModel
    {
        public DVDModel $DVD;
        public ManageDVDDetailViewStateEnum $state;
    }
}

