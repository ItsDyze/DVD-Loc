<?php

namespace Models\QueryModel
{
    class DVDQueryModel extends BaseQueryModel
    {
        public bool|null $IsOffered = null;
        public string|null $OrderBy = null;
        public string|null $OrderDesc = null;
        public string|null $Search = null;

        public function getQueryString(): string
        {
            return "IsOffered=$this->IsOffered&".
                "OrderBy=$this->OrderBy&".
                "OrderDesc=$this->OrderDesc&".
                "Search=$this->Search&".
                "Limit=$this->Limit&".
                "Offset=$this->Offset";
        }

        public function setFromQueryString(array $param): void
        {

            $this->IsOffered = array_key_exists('IsOffered', $param) && $param['IsOffered'] !== ''
                ? filter_var($param['IsOffered'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
                : null;
            $this->OrderBy = $param['OrderBy'] ?? '';
            $this->OrderDesc = $param['OrderDesc'] ?? '';
            $this->Search = $param['Search'] ?? '';
            $this->Limit = isset($param['Limit']) ? (int)$param['Limit'] : 10;
            $this->Offset = isset($param['Offset']) ? (int)$param['Offset'] : 0;
        }
    }
}

