<?php
namespace Views\Manage\Dashboard
{

    use Models\ViewModels\DashboardViewModel;
    use Models\ViewModels\LayoutViewModel;
    use Views\BaseView;

    class DashboardView extends BaseView
    {
        private DashboardViewModel $data;

        function __construct(DashboardViewModel $viewModel)
        {
            $this->viewName="Manage/Dashboard/DashboardView";
            $this->subTitle="Dashboard";

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