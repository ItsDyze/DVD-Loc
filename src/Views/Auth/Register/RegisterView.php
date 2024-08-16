<?php
namespace Views\Auth\Register
{

    use Models\ViewModels\LayoutViewModel;
    use Models\ViewModels\RegisterViewModel;
    use Views\BaseView;

    class RegisterView extends BaseView
    {
        public RegisterViewModel $data;

        public function __construct(RegisterViewModel $dataModel)
        {
            $this->viewName="Auth/Register/RegisterView";
            $this->subTitle="Register";
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