<?php
namespace Views\Auth\Login
{

    use Models\LayoutViewModel;
    use Models\LoginViewModel;
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

