<?php

namespace Views\Manage\DVD
{

    use Models\ViewModels\ManageDVDViewModel;
    use Models\ViewModels\LayoutViewModel;
    use Views\BaseView;

    class ManageDVDView extends BaseView
    {
        private ManageDVDViewModel $data;

        function __construct(ManageDVDViewModel $viewModel)
        {
            $this->viewName="Manage/DVD/ManageDVDView";
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

