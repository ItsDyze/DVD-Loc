<?php

namespace Views\Manage\DVD
{

    use Models\ViewModels\DVDViewModel;
    use Models\ViewModels\LayoutViewModel;
    use Views\BaseView;

    class DVDView extends BaseView
    {
        private DVDViewModel $data;

        function __construct(DVDViewModel $viewModel)
        {
            $this->viewName="Manage/DVD/DVDView";
            $this->subTitle="DVD";

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

