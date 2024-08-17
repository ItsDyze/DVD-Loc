<?php

namespace Utils\Query
{

    class QueryBuilder
    {
        protected array $select = [];
        protected string $table;
        protected array $where = [];
        protected int|null $limit;
        protected int|null $offset;
        protected string|null $orderBy;
        protected bool|null $orderDesc;
        protected array $params;

        function __construct()
        {
            $this->limit = null;
            $this->offset = null;
            $this->orderDesc = null;
            $this->orderBy = null;
            $this->params = [];
        }

        public function select($columns = '*') {
            $this->select = is_array($columns) ? $columns : func_get_args();
            return $this;
        }

        public function from($table) {
            $this->table = $table;
            return $this;
        }

        public function where($column, $operator, $value) {
            $this->where[] = "$column $operator ?";
            $this->params[] = $value;
            return $this;
        }

        public function limit(int $offset, int $limit) {
            $this->limit = $limit;
            $this->offset = $offset;
            return $this;
        }

        public function orderBy(string $column, bool $descending = true) {
            $this->orderDesc = $descending;
            $this->orderBy = $column;
            return $this;
        }

        public function getQuery():QueryModel {
            $sql = "SELECT " . implode(', ', $this->select) . " FROM $this->table";
            if (!empty($this->where)) {
                $sql .= " WHERE " . implode(' AND ', $this->where);
            }
            if ($this->orderBy !== "" && $this->orderDesc !== null) {
                $sql .= " ORDER BY $this->orderBy " . ($this->orderDesc ? 'DESC' : 'ASC') . " ";
            }
            if ($this->limit) {
                $sql .= " LIMIT $this->offset, $this->limit";
            }
            $sql .= ";";
            $result = new QueryModel();
            $result->sql = $sql;
            $result->params = $this->params;

            return $result;
        }
    }
}

