<?php

namespace Models\ViewModels
{

    use Interfaces\IViewModel;

    class DashboardViewModel implements IViewModel
    {
        public int $DVDCount;
        public int $OfferedDVDCount;
    }
}