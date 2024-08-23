<?php
namespace Controllers\Error
{


    use Models\ErrorModel;
    use Models\Exceptions\BadRouteException;
    use Views\Error\Default\DefaultView;
    use Views\Error\Unauthorized\UnauthorizedView;

    class ErrorController {

        public function unauthorized(): void
        {
            new UnauthorizedView();
        }

        public function serverError($exception): void
        {
            $errorModel = new ErrorModel();
            $errorModel->exception = $exception;
            new DefaultView($errorModel);
        }

        public function handle(): void
        {
            $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            if(empty($requestedController))
            {
                throw new BadRouteException("Error");
            }

            if(!isset($requestedController[2]))
            {
                $this->serverError("Unknown error.");
                exit;
            }

            switch (strtolower($requestedController[2])) {
                case 'unauthorized' :
                    $this->unauthorized();
                    break;
                case '/' :
                case 'server-error' :
                default:
                    $this->serverError("Unknown error.");
                    break;
            }
        }
    }
}