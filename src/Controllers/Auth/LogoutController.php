<?php

namespace Controllers\Auth;

use Controllers\BaseController;
use Models\ViewModels\LoginViewModel;
use Models\ViewModels\LoginViewStateEnum;
use Views\Auth\Login\LoginView;

class LogoutController extends BaseController
{
    public function get(): void
    {
        $data = new LoginViewModel();
        $data->viewState = LoginViewStateEnum::Logout;

        setcookie('jwt', '', -1, '/');

        $view = new LoginView($data);
        $view->render();
    }
}