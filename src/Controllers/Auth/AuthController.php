<?php
    namespace Controllers\Auth
    {

        use Models\LoginViewModel;
        use Models\LoginViewStateEnum;
        use Models\RegisterViewModel;
        use Models\RegisterViewStateEnum;
        use Models\UserModel;
        use Services\AuthService;
        use Views\Auth\Login\LoginView;
        use Views\Auth\Register\RegisterView;

        class AuthController {
            public function index(): void
            {

                $data = new LoginViewModel();

                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $authService = AuthService::getInstance();

                    $login = trim($_POST["email"]);
                    $password = trim($_POST["password"]);

                    $user = $authService->authenticate($login, $password);

                    if($user)
                    {
                        $data->viewState = LoginViewStateEnum::Success;

                    }
                    else
                    {
                        $data->viewState = LoginViewStateEnum::FailedServer;
                    }
                }
                else
                {

                    $data->viewState = LoginViewStateEnum::InProgress;
                }

                new LoginView($data);
            }

            public function register(): void
            {
                if ($_SERVER["REQUEST_METHOD"] == "POST")
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

                }
                else // GET
                {
                    $data = new RegisterViewModel();
                    $data->viewState = RegisterViewStateEnum::InProgress;
                }

                new RegisterView($data);
            }
        }
    }