<?php

namespace Views
{

    use Interfaces\IViewModel;
    use Models\LayoutViewModel;

    abstract class BaseView
    {
        protected string $viewName;
        protected string $subTitle;
        protected string $subContent;
        protected LayoutViewModel $layoutData;
        protected string $cssInclude;

        protected abstract function render();

        protected function renderLayout(LayoutViewModel $viewModel, IVIewModel $contentData): void
        {
            if(!isset($this->viewName))
            {
                error_log("No view name passed to the layout");
                die();
            }

            $this->layoutData = $viewModel;
            $this->subContent = $this->loadView($this->viewName, $contentData);
            $this->cssInclude = $this->loadCSS($this->viewName, $contentData);
            require "Layout/LayoutView.template.php";
        }

        protected function loadView(string $viewFiles, IViewModel $pData): string
        {
            $data = $pData;
            ob_start();
            require $viewFiles . ".template.php";
            return ob_get_clean();
        }

        protected function loadCSS(string $viewName, IViewModel $pData): string
        {

            $data = $pData;
            ob_start();
            require $viewName . ".style.php";
            return ob_get_clean();
        }
    }
}