<?php namespace Services; ?>
<?php

require_once SRC . "Services/SingletonBaseService.php";
class DataService extends SingletonBaseService 
{
    private $DBConfBaseKey = "C218_DataStore_";

    private $dbContext;
     
    private $user;
    private $pass;
    private $host;
    private $db;

    protected function __construct() {
        $userConf = getenv($this->DBConfBaseKey . "User");
        if (isset($userConf))
        {
            $this->user = $userConf;
        }
        else
        {
            echo "C218_DataStore_User key not set";
            die();
        }

        $passConf = getenv($this->DBConfBaseKey . "Pass");
        if (isset($passConf))
        {
            $this->pass = $passConf;
        }
        else
        {
            echo "C218_DataStore_Pass key not set";
            die();
        }

        $hostConf = getenv($this->DBConfBaseKey . "Host");
        if (isset($hostConf))
        {
            $this->host = $hostConf;
        }
        else
        {
            echo "C218_DataStore_Host key not set";
            die();
        }

        $dbNameConf = getenv($this->DBConfBaseKey . "DBName");
        if (isset($dbNameConf))
        {
            $this->db = $dbNameConf;
        }
        else
        {
            echo "C218_DataStore_DBName key not set";
            die();
        }

        $this->dbContext = $this->GetDBContext();
    }

    protected function GetDBContext()
    {
        if(isset($this->dbContext))
        {
            return $this->dbContext;
        }
        
        try 
        {
            $this->dbContext = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
            // Ne retourner que les erreurs
            $this->dbContext->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->dbContext;
        }
        catch (PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    protected function ExecuteStatement($statement, $parameters)
    {
        if(substr_count($statement, "?") == array_count_values($parameters))
        {
            echo "Too few or too many parameters for the provided statement";
            die();
        }

        $query = $this->GetDBContext()->prepare($statement);
        return $query->execute($parameters);
    }
}

?>