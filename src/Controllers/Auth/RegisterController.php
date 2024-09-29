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
        $authService = new AuthService();

        $user = new UserModel();
        $user->FirstName = trim($_POST["FirstName"]);
        $user->LastName = trim($_POST["LastName"]);
        $user->Email = trim($_POST["Email"]);
        $user->Password = trim($_POST["Password"]);
        $user->City = trim($_POST["City"]);
        $user->PostCode = trim($_POST["PostCode"]);
        $user->AddressLine = trim($_POST["AddressLine"]);

        $data = new RegisterViewModel();
        if($user->Email == null ||
            $user->Password == null ||
            $user->LastName == null ||
            $user->City == null ||
            $user->PostCode == null ||
            $user->AddressLine == null)
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