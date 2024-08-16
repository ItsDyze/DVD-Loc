<?php
    namespace Controllers\Auth
    {

        use Models\Exceptions\BadRouteException;
        use Models\Exceptions\RouteNotFoundException;
        use Models\JWTModel;
        use Models\UserModel;
        use Models\ViewModels\LoginViewModel;
        use Models\ViewModels\LoginViewStateEnum;
        use Models\ViewModels\RegisterViewModel;
        use Models\ViewModels\RegisterViewStateEnum;
        use Services\AuthService;
        use Utils\JWTUtils;
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
                }
                else
                {
                    if(isset($_COOKIE['jwt']) &&
                        JWTUtils::isValid($_COOKIE['jwt']))
                    {
                        $data->viewState = LoginViewStateEnum::Success;
                    }
                    else
                    {
                        $data->viewState = LoginViewStateEnum::InProgress;
                    }
                }

                new LoginView($data);
            }

            public function logout(): void
            {

                $data = new LoginViewModel();
                $data->viewState = LoginViewStateEnum::Logout;

                setcookie('jwt', '', -1, '/');

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

            /**
             * @throws BadRouteException on routes not matching the required arguments
             * @throws RouteNotFoundException on routes matching but not found
             */
            public function handle(): void
            {
                $requestedController = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                if(empty($requestedController))
                {
                    throw new BadRouteException("Auth");
                }

                if(!isset($requestedController[2]))
                {
                    $this->index();
                    exit;
                }

                switch (strtolower($requestedController[2])) {
                    case '/' :
                    case 'login' :
                        $this->index();
                        break;
                    case 'logout' :
                        $this->logout();
                        break;
                    case 'register' :
                        $this->register();
                        break;
                    default:
                        throw new RouteNotFoundException("Auth");
                }
            }
        }
    }