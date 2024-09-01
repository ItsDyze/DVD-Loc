<?php
namespace Views\DVD
{

    use Models\ViewModels\DVDViewModel;
    use Models\ViewModels\LayoutViewModel;
    use Views\BaseView;

    class DVDView extends BaseView
    {
        private DVDViewModel $data;

        function __construct(DVDViewModel $viewModel)
        {
            $this->viewName="DVD/DVDView";
            $this->subTitle="DVD";
            $this->data = $viewModel;
        }

        public function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, $this->data);
        }
    }
}