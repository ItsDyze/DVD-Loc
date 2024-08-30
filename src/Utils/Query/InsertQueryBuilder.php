<?php

namespace Utils\Query
{

    class InsertQueryBuilder
    {
        protected string $table;
        protected array $col = [];
        protected array $params;

        function __construct()
        {
            $this->params = [];
        }

        public function insert($table) {
            $this->table = $table;
            return $this;
        }

        public function value($column, $value) {
            $this->col[] = $column;
            $this->params[] = $value;
            return $this;
        }

        public function getQuery():QueryModel {
            $sql = "INSERT INTO " . $this->table;
            $sql .= " ( " . implode(', ', $this->col) . ") ";

            $sql .= " VALUES (";
            $firstParam = true;
            foreach ($this->params as $param) {
                if($firstParam)
                {
                    $firstParam = false;
                    $sql .= "?";
                }
                else
                {
                    $sql .= ", ?";
                }
            }

            $sql .= " )";
            $sql .= ";";
            $result = new QueryModel();
            $result->sql = $sql;
            $result->params = $this->params;

            return $result;
        }
    }
}

