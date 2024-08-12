<?php
namespace Views\Error\Unauthorized
{


    use Interfaces\IViewModel;
    use Models\LayoutViewModel;
    use Views\BaseView;

    class UnauthorizedView extends BaseView
    {
        private IViewModel $data;

        function __construct()
        {
            $this->viewName="Error/Unauthorized/UnauthorizedView";
            $this->subTitle="Unauthorized";

            $this->render();
        }

        protected function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, null);
        }
    }
}