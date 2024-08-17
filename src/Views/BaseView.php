<?php

namespace Views
{

    use Interfaces\IViewModel;
    use Models\ViewModels\LayoutViewModel;
    use Utils\JWTUtils;

    abstract class BaseView
    {
        protected string $viewName;
        protected string $subTitle;
        protected string $subContent;
        protected string $subScripts;
        public LayoutViewModel $layoutData;
        protected string $cssInclude;

        protected abstract function render();

        protected function renderLayout(LayoutViewModel $viewModel, IVIewModel|null $contentData, bool $hasJS = false): void
        {
            if(!isset($this->viewName))
            {
                error_log("No view name passed to the layout");
                die();
            }

            $this->layoutData = $viewModel;
            if(isset($_COOKIE["jwt"]) && JWTUtils::isValid($_COOKIE["jwt"]))
            {
                $this->layoutData->isLoggedIn = true;
                $this->layoutData->displayName = JWTUtils::getValue($_COOKIE["jwt"], "displayName");
                $this->layoutData->isAdmin = JWTUtils::getValue($_COOKIE["jwt"], "isAdmin");

            }
            else
            {
                $this->layoutData->isLoggedIn = false;
            }

            if($hasJS)
            {
                $this->subScripts = $this->loadJS($this->viewName);
            }
            else
            {
                $this->subScripts = "";
            }
            $this->subContent = $this->loadView($this->viewName, $contentData);
            $this->cssInclude = $this->loadCSS($this->viewName, $contentData);
            require "Layout/LayoutView.template.php";
        }

        protected function loadJS(string $viewFiles): string
        {
            ob_start();
            include $viewFiles . ".js";
            return ob_get_clean();
        }

        protected function loadView(string $viewFiles, IViewModel|null $pData): string
        {
            $data = $pData;
            ob_start();
            require $viewFiles . ".template.php";
            return ob_get_clean();
        }

        protected function loadCSS(string $viewName, IViewModel|null $pData): string
        {

            $data = $pData;
            ob_start();
            require $viewName . ".style.css";
            return ob_get_clean();
        }
    }
}