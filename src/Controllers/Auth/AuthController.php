<?php namespace Controllers\Auth; ?>
<?php

    class AuthController {
        public function Index() {
            $title = "Login";
            $view = SRC . "Views/Auth/Login/Login.php";
            include SRC . 'Views/Layout/Layout.php';
        }

        public function Register() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") 
            {
                include_once SRC . "Services/AuthService.php";
                include_once SRC . "Models/UserModel.php";
                $authService = AuthService::getInstance();

                $user = new UserModel();
                $user->FirstName = trim($_POST["FirstName"]);
                $user->LastName = trim($_POST["LastName"]);
                $user->Email = trim($_POST["Email"]);
                $user->Password = trim($_POST["Password"]);
    
                if ($authService->CreateUser($user)) {
                    echo "Registration successful!";
                } else {
                    echo "Error: Could not register user.";
                }
            } 
            else // GET
            {
                $title = "Register";
                $view = SRC . "Views/Auth/Register/Register.php";
                include SRC . 'Views/Layout/Layout.php';
            }
        }
    }
?>