<?php
namespace Views\Home
{

    use Models\HomeViewModel;
    use Models\LayoutViewModel;
    use Views\BaseView;

    class HomeView extends BaseView
    {
        private HomeViewModel $data;

        function __construct(HomeViewModel $viewModel)
        {
            $this->viewName="Home/HomeView";
            $this->subTitle="Home";

            $this->data = $viewModel;
            $this->render();
        }

        protected function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, $this->data);
        }
    }
}