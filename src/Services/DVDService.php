<?php

namespace Services
{

    use Exception;
    use Models\DVDModel;
    use Models\QueryModel\DVDQueryModel;
    use Utils\Query\QueryBuilder;

    class DVDService extends DataService
    {

        protected function __construct() {
            parent::__construct();
        }

        public function getDVDCount(DVDQueryModel $queryModel = null):int
        {
            $queryBuilder = (new QueryBuilder())
                ->select("Count(id)")
                ->from("dvds");
            if($queryModel)
            {
                if($queryModel->IsOffered != null)
                {
                    $queryBuilder->where("IsOffered", "=", $queryModel->IsOffered);
                }
            }


            $query = $queryBuilder->getQuery();
            $queryResult = $this->fetchValue($query->sql, $query->params);

            if($queryResult)
            {
                return $queryResult;
            }

            return 0;
        }

        public function getDVDs(DVDQueryModel $query): array
        {
            $result = array();
            $query = "SELECT Id, Title, LocalTitle, Synopsis, Notation, Note, Certification, IsOffered, Quantity, Price, Year FROM dvds LIMIT ?, ?;";

            $values = array(
                $offset = $query->offset,
                $limit = $query->limit
            );

            $queryResult = $this->fetchAllStatement($query, $values);

            if($queryResult && array_count_values($queryResult) > 0)
            {
                foreach($queryResult as $row)
                {
                    array_push($result, $row);
                }
            }

            return $result;
        }
    }
}

