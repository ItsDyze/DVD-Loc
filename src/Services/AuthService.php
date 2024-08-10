<?php namespace Services; ?>
<?php

require_once SRC . "Services/DataService.php";
require_once SRC . "Utils/SecurityUtils.php";
class AuthService extends DataService {

    protected function __construct() {
        parent::__construct();
        // On utilise le singleton
    }

    public function CreateUser($user)
    {
        $query = "INSERT INTO Users (LastName, FirstName, Email, Password) VALUES (?, ?, ?, ?);";

        $password = SecurityUtils::HashPassword($user->Password);

        $values = array(
            $user->LastName,
            $user->FirstName,
            $user->Email,
            $password
        );

        $queryResult = $this->ExecuteStatement($query, $values);

        return $queryResult;
    }

}

?>