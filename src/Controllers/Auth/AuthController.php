<?php
    namespace Controllers\Auth
    {

        use Models\LoginViewModel;
        use Models\RegisterViewModel;
        use Models\UserModel;
        use Services\AuthService;
        use Views\Auth\Login\LoginView;
        use Views\Auth\Register\RegisterView;

        class AuthController {
            public function index(): void
            {
                $data = new LoginViewModel();
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

                    if ($authService->createUser($user)) {
                        echo "Registration successful!";
                    } else {
                        echo "Error: Could not register user.";
                    }
                }
                else // GET
                {
                    $data = new RegisterViewModel();
                    new RegisterView($data);
                }
            }
        }
    }