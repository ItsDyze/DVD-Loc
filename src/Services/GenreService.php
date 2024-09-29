<?php

namespace Services;


use Utils\Query\QueryBuilder;

class GenreService extends DataService
{

    function __construct() {
        parent::__construct();
    }

    public function getAll(): array
    {
        $result = array();
        $queryBuilder = (new QueryBuilder())
            ->select(["Id", "Name"])
            ->from("genres")
            ->orderBy("Name", false);

        $query = $queryBuilder->getQuery();

        $queryResult = $this->fetchAllStatement($query->sql, $query->params);

        if($queryResult && count($queryResult) > 0)
        {
            foreach($queryResult as $row)
            {
                $result[] = $row;
            }
        }

        return $result;
    }
}