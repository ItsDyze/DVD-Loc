<?php
namespace Views\Auth\Login
{

    use Models\ViewModels\LayoutViewModel;
    use Models\ViewModels\LoginViewModel;
    use Views\BaseView;

    class LoginView extends BaseView
    {

        public LoginViewModel $data;
        private string $content;

        public function __construct(LoginViewModel $dataModel)
        {
            $this->viewName="Auth/Login/LoginView";
            $this->subTitle="Login";
            $this->data = $dataModel;
        }

        public function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, $this->data);
        }
    }
}

