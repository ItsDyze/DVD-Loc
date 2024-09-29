<?php
namespace Views\Search
{

    use Models\ViewModels\LayoutViewModel;
    use Models\ViewModels\SearchViewModel;
    use Views\BaseView;

    class SearchView extends BaseView
    {
        private SearchViewModel $data;

        function __construct(SearchViewModel $viewModel)
        {
            $this->viewName="Search/SearchView";
            $this->subTitle="Search";
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