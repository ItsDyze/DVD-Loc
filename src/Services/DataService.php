<?php

namespace Services {

    use PDO;
    use PDOException;
    use Utils\Query\QueryUtils;

    class DataService extends SingletonBaseService
    {
        private string $DBConfBaseKey = "C218_DataStore_";

        private ?PDO $dbContext;

        private string $user;
        private string $pass;
        private string $host;
        private string $db;

        protected function __construct()
        {
            $userConf = getenv($this->DBConfBaseKey . "User");
            if ($userConf != null)
            {
                $this->user = $userConf;
            } else
            {
                echo "C218_DataStore_User key not set";
                die();
            }

            $passConf = getenv($this->DBConfBaseKey . "Pass");
            if ($passConf != null)
            {
                $this->pass = $passConf;
            } else
            {
                echo "C218_DataStore_Pass key not set";
                die();
            }

            $hostConf = getenv($this->DBConfBaseKey . "Host");
            if ($hostConf != null)
            {
                $this->host = $hostConf;
            } else
            {
                echo "C218_DataStore_Host key not set";
                die();
            }

            $dbNameConf = getenv($this->DBConfBaseKey . "DBName");
            if ($dbNameConf != null)
            {
                $this->db = $dbNameConf;
            } else
            {
                echo "C218_DataStore_DBName key not set";
                die();
            }

            $this->dbContext = $this->getDBContext();
        }

        protected function getDBContext()
        {
            if (isset($this->dbContext))
            {
                return $this->dbContext;
            }

            try
            {
                $this->dbContext = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
                // Ne retourner que les erreurs
                $this->dbContext->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->dbContext;
            } catch (PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
                die();
            }
        }

        protected function executeStatement($statement, $parameters)
        {
            if (substr_count($statement, "?") == array_count_values($parameters))
            {
                echo "Too few or too many parameters for the provided statement";
                die();
            }

            $query = $this->GetDBContext()->prepare($statement);
            return $query->execute($parameters);
        }

        protected function insertStatement($statement, $parameters)
        {
            $this->validateStatementAndParameters($statement, $parameters);

            $query = $this->GetDBContext()->prepare($statement);
            $query->execute($parameters);
            return $this->GetDBContext()->lastInsertId();
        }

        protected function fetchValue($statement, $parameters)
        {
            $this->validateStatementAndParameters($statement, $parameters);

            $query = $this->GetDBContext()->prepare($statement);
            $query->execute($parameters);
            return $query->fetchColumn();
        }

        protected function fetchStatement($statement, $parameters, $className = null)
        {
            $this->validateStatementAndParameters($statement, $parameters);

            $query = $this->GetDBContext()->prepare($statement);
            $query->execute($parameters);

            if($className != null)
            {
                $query->setFetchMode(PDO::FETCH_CLASS, $className);
                return $query->fetch();
            }
            else
            {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        }

        protected function fetchAllStatement($statement, $parameters)
        {
            $this->validateStatementAndParameters($statement, $parameters);

            $query = $this->GetDBContext()->prepare($statement);
            $query->execute($parameters);
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        private function validateStatementAndParameters($statement, $parameters): void
        {
            $requiredParameters = substr_count($statement, "?");
            $providedParameters = count($parameters) ?? 0;

            if ($requiredParameters != $providedParameters)
            {
                echo "Too few or too many parameters for the provided statement";
                die();
            }
        }
    }
}