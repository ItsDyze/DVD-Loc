<?php

namespace Services
{

    use Models\UserModel;
    use Utils\SecurityUtils;

    class AuthService extends DataService {

        protected function __construct() {
            parent::__construct();
            // On utilise le singleton
        }

        public function createUser($user)
        {
            $query = "INSERT INTO Users (LastName, FirstName, Email, Password) VALUES (?, ?, ?, ?);";

            $password = SecurityUtils::hashPassword($user->Password);

            $values = array(
                $user->LastName,
                $user->FirstName,
                $user->Email,
                $password
            );

            return $this->executeStatement($query, $values);
        }

        public function authenticate($email, $password): ?UserModel
        {
            $query = "SELECT * FROM Users WHERE (Email = ?);";
            $values = array(
                $email
            );
            $queryResult = $this->fetchStatement($query, $values);

            if($queryResult)
            {
                $result = new UserModel();
                $result->Email = $queryResult->Email;
                $result->FirstName = $queryResult->FirstName;
                $result->LastName = $queryResult->LastName;

                if(password_verify($password, $queryResult->Password))
                {
                    return $result;
                }
                else
                {
                    error_log("Failed to authenticate using provided credentials");
                    return null;
                }
            }
            else
            {
                error_log("Failed to authenticate using provided credentials");
                return null;
            }
        }

    }
}