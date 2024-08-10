<?php

namespace Models
{

    use Interfaces\IViewModel;

    class LayoutViewModel implements IViewModel
    {
        public string $pageSubTitle;
        public array $cssIncludes;
    }
}