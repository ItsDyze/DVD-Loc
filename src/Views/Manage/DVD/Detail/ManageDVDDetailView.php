<?php

namespace Views\Manage\DVD\Detail
{

    use Models\ViewModels\LayoutViewModel;
    use Models\ViewModels\ManageDVDDetailViewModel;
    use Models\ViewModels\ManageDVDDetailViewStateEnum;
    use Views\BaseView;

    class ManageDVDDetailView extends BaseView
    {
        private ManageDVDDetailViewModel $data;

        function __construct(ManageDVDDetailViewModel $viewModel)
        {
            $this->viewName="Manage/DVD/Detail/ManageDVDDetailView";
            $this->subTitle="DVD";

            $this->data = $viewModel;
        }

        public function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, $this->data, true);
        }
    }
}

