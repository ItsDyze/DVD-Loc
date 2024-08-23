<?php

namespace Views\Error\Default
{

    use Models\ErrorModel;
    use Models\ViewModels\LayoutViewModel;
    use Views\BaseView;

    class DefaultView extends BaseView
    {
        private ErrorModel $data;

        function __construct(ErrorModel $data)
        {
            $this->data = $data;

            $this->viewName="Error/Default/DefaultView";
            $this->subTitle="Server Error";

        }

        public function render(): void
        {
            $layoutData = new LayoutViewModel();
            $layoutData -> pageSubTitle = $this->subTitle;
            parent::renderLayout($layoutData, $this->data);
        }
    }
}

