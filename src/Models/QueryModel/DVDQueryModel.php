<?php

namespace Models\QueryModel
{
    class DVDQueryModel extends BaseQueryModel
    {
        public bool|null $IsOffered = null;

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

            parent::setFromListingQueryString($param);
        }
    }
}

