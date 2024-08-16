<?php

namespace Models\ViewModels
{

    use Interfaces\IViewModel;

    class LayoutViewModel implements IViewModel
    {
        public string $pageSubTitle;
        public array $cssIncludes;
        public string $displayName;
        public bool $isLoggedIn;
        public bool $isAdmin;
    }
}