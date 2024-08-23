<?php

namespace Views\Manage\DVD\List
{

    use Models\ViewModels\LayoutViewModel;
    use Models\ViewModels\ManageDVDListViewModel;
    use Views\BaseView;

    class ManageDVDListView extends BaseView
    {
        private ManageDVDListViewModel $data;

        function __construct(ManageDVDListViewModel $viewModel)
        {
            $this->viewName="Manage/DVD/List/ManageDVDListView";
            $this->subTitle="DVD";

            $this->data = $viewModel;
            $this->render();
        }

        protected function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, $this->data, true);
        }
    }
}

