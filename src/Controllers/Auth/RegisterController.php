<?php

namespace Controllers\Auth;

use Controllers\BaseController;
use Models\UserModel;
use Models\ViewModels\RegisterViewModel;
use Models\ViewModels\RegisterViewStateEnum;
use Services\AuthService;
use Views\Auth\Register\RegisterView;

class RegisterController extends BaseController
{
    public function get(): void
    {
        $data = new RegisterViewModel();
        $data->viewState = RegisterViewStateEnum::InProgress;
        $view = new RegisterView($data);
        $view->render();
    }

    public function post(): void
    {
        $authService = AuthService::getInstance();

        $user = new UserModel();
        $user->FirstName = trim($_POST["FirstName"]);
        $user->LastName = trim($_POST["LastName"]);
        $user->Email = trim($_POST["Email"]);
        $user->Password = trim($_POST["Password"]);

        $data = new RegisterViewModel();
        if($user->Email == null || $user->Password == null)
        {
            $data->viewState = RegisterViewStateEnum::FailedValidation;
        }
        else if ($authService->createUser($user))
        {
            $data->viewState = RegisterViewStateEnum::Success;
        }
        else
        {
            $data->viewState = RegisterViewStateEnum::FailedServer;
        }

        $view = new RegisterView($data);
        $view->render();
    }
}