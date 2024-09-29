<?php

namespace Services
{

    use Models\UserModel;
    use Utils\SecurityUtils;

    class AuthService extends DataService {

        function __construct() {
            parent::__construct();
        }

        public function createUser($user)
        {
            $query = "INSERT INTO Users (LastName, FirstName, Email, City, PostCode, AddressLine, Password) VALUES (?, ?, ?, ?, ?, ?, ?);";

            $password = SecurityUtils::hashPassword($user->Password);

            $values = array(
                $user->LastName,
                $user->FirstName,
                $user->Email,
                $user->City,
                $user->PostCode,
                $user->AddressLine,
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
                $result->Id = $queryResult->Id;
                $result->Email = $queryResult->Email;
                $result->FirstName = $queryResult->FirstName;
                $result->LastName = $queryResult->LastName;

                if(password_verify($password, $queryResult->Password))
                {
                    return $result;
                }
            }

            error_log("Failed to authenticate using provided credentials");
            return null;
        }

        public function getUserById(string $userId)
        {
            $query = "SELECT * FROM Users WHERE (Id = ?);";
            $values = array(
                $userId
            );
            $queryResult = $this->fetchStatement($query, $values);

            $result = new UserModel();

            if($queryResult)
            {
                $result->Id = $queryResult->Id;
                $result->Email = $queryResult->Email;
                $result->FirstName = $queryResult->FirstName;
                $result->LastName = $queryResult->LastName;
                $result->City = $queryResult->City;
                $result->PostCode = $queryResult->PostCode;
                $result->AddressLine = $queryResult->AddressLine;

                return $result;
            }

            return null;
        }

        public function update(UserModel $user)
        {
            $this->getDBContext()->beginTransaction();

            $query = "UPDATE Users SET LastName = ?, FirstName = ?, Email = ?, City = ?, PostCode = ?, AddressLine = ? WHERE Id = ?;";

            $values = array(
                $user->LastName,
                $user->FirstName,
                $user->Email,
                $user->City,
                $user->PostCode,
                $user->AddressLine,
                $user->Id
            );

            $updateResult = $this->executeStatement($query, $values);

            if($updateResult && isset($user->Password))
            {
                $password = SecurityUtils::hashPassword($user->Password);
                $query = "UPDATE Users SET Password = ? WHERE Id = ?;";
                $values = array(
                    $password,
                    $user->Id
                );
                $updateResult = $this->executeStatement($query, $values);
            }

            if(!$updateResult)
            {
                $this->getDBContext()->rollBack();
            }
            else
            {
                $this->getDBContext()->commit();
            }

            return $updateResult;
        }

    }
}