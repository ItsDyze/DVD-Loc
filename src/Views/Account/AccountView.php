<?php
namespace Views\Account
{

    use Models\ViewModels\AccountViewModel;
    use Models\ViewModels\LayoutViewModel;
    use Views\BaseView;

    class AccountView extends BaseView
    {
        private AccountViewModel $data;

        function __construct(AccountViewModel $viewModel)
        {
            $this->viewName="Account/AccountView";
            $this->subTitle="Account";
            $this->data = $viewModel;
        }

        public function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, $this->data, false);
        }
    }
}