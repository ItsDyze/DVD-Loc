<?php

namespace Controllers\Auth;

use Controllers\BaseController;
use Models\JWTModel;
use Models\ViewModels\LoginViewModel;
use Models\ViewModels\LoginViewStateEnum;
use Services\AuthService;
use Utils\JWTUtils;
use Views\Auth\Login\LoginView;

class LoginController extends BaseController
{
    public function get():void
    {
        $data = new LoginViewModel();

        $data->viewState = isset($_COOKIE['jwt']) && JWTUtils::isValid($_COOKIE['jwt']) ?
            LoginViewStateEnum::Success:
            LoginViewStateEnum::InProgress;

        $view = new LoginView($data);
        $view->render();
    }

    public function post():void
    {
        $data = new LoginViewModel();

        $authService = AuthService::getInstance();

        $login = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $user = $authService->authenticate($login, $password);

        if($user)
        {

            $jwt = new JWTModel();
            $jwt->iat = time();
            $jwt->nbf = time();
            $jwt->exp = time() + 24*60*60;
            $jwt->displayName = $user->getDisplayName();
            $jwt->isAdmin = $user->Email == "contact@dyze.lu";

            $token = JWTUtils::encode((array) $jwt);

            setcookie("jwt", $token, JWTUtils::getValue($token, "exp"), "/");
            $data->viewState = LoginViewStateEnum::Success;
        }
        else
        {
            $data->viewState = LoginViewStateEnum::FailedServer;
        }

        $view = new LoginView($data);
        $view->render();
    }
}