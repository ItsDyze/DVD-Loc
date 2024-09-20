<?php

namespace Models\QueryModel
{
    class HomeQueryModel extends BaseQueryModel
    {
        public int|null $GenreId = null;
        public int|null $TypeId = null;

        public function getQueryString(): string
        {
            return "GenreId=$this->GenreId&".
                "TypeId=$this->TypeId&".
                "Search=$this->Search&";
        }

        public function setFromQueryString(array $param): void
        {
            $this->GenreId = array_key_exists('GenreId', $param) && $param['GenreId'] !== ''
                ? filter_var($param['GenreId'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)
                : null;
            $this->TypeId = array_key_exists('TypeId', $param) && $param['TypeId'] !== ''
                ? filter_var($param['TypeId'], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)
                : null;

            parent::setFromListingQueryString($param);
        }
    }
}

