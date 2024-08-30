<?php

namespace Models\QueryModel
{
    class BaseQueryModel
    {
        public int $Limit = 10;
        public int $Offset = 0;
        public string|null $OrderBy = null;
        public string|null $OrderDesc = null;
        public string|null $Search = null;

        public function setFromListingQueryString(array $param): void
        {
            $this->OrderBy = $param['OrderBy'] ?? '';
            $this->OrderDesc = $param['OrderDesc'] ?? '';
            $this->Search = $param['Search'] ?? '';
            $this->Limit = isset($param['Limit']) ? (int)$param['Limit'] : 10;
            $this->Offset = isset($param['Offset']) ? (int)$param['Offset'] : 0;
        }
    }
}

