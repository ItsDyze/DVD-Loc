<?php
namespace Controllers\Error
{


    use Controllers\BaseController;
    use Models\ErrorModel;
    use Views\Error\Default\DefaultView;

    class ErrorController extends BaseController {


        public function get(): void
        {
            $errorModel = new ErrorModel();
            new DefaultView($errorModel);
        }
    }
}