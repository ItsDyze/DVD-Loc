<?php

namespace Controllers\Account;

use Models\UserModel;
use Models\ViewModels\AccountViewModel;
use Services\AuthService;
use Utils\JWTUtils;
use Views\Account\AccountView;

class AccountController
{
    public function get()
    {
        $data = new AccountViewModel();
        $service = new AuthService();
        $userId = JWTUtils::getValue($_COOKIE["jwt"], "userId");

        $data->User = $service->getUserById($userId);

        $view = new AccountView($data);
        $view->render();
    }

    public function post(): void
    {
        $model = new UserModel();
        $service = new AuthService();

        $this->postToUserModel($model);

        $model->Id = JWTUtils::getValue($_COOKIE["jwt"], "userId");

        $update = $service->update($model);

        header("Location: /account");
        die();
    }

    private function postToUserModel(UserModel $user)
    {
        $user->FirstName = trim($_POST["FirstName"]);
        $user->LastName = trim($_POST["LastName"]);
        $user->Email = trim($_POST["Email"]);
        $user->Password = trim($_POST["Password"]);
        $user->City = trim($_POST["City"]);
        $user->PostCode = trim($_POST["PostCode"]);
        $user->AddressLine = trim($_POST["AddressLine"]);
    }
}