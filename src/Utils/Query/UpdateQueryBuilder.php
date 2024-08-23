<?php

namespace Utils\Query
{

    class UpdateQueryBuilder
    {
        protected string $table;
        protected array $where = [];
        protected array $set = [];
        protected array $params;

        function __construct()
        {
            $this->params = [];
        }

        public function update($table) {
            $this->table = $table;
            return $this;
        }

        public function set($column, $value) {
            $this->set[] = "$column = ?";
            $this->params[] = $value;
            return $this;
        }

        public function where($column, $operator, $value) {
            $this->where[] = "$column $operator ?";
            $this->params[] = $value;
            return $this;
        }

        public function getQuery():QueryModel {
            $sql = "UPDATE " . $this->table;
            $sql .= " SET " . implode(', ', $this->set);
            if (!empty($this->where)) {
                $sql .= " WHERE " . implode(' AND ', $this->where);
            }
            $sql .= ";";
            $result = new QueryModel();
            $result->sql = $sql;
            $result->params = $this->params;

            return $result;
        }
    }
}

