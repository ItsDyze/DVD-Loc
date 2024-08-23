<?php

namespace Services
{

    use Exception;
    use Models\DVDModel;
    use Models\QueryModel\DVDQueryModel;
    use Utils\Query\QueryBuilder;
    use Utils\Query\UpdateQueryBuilder;

    class DVDService extends DataService
    {

        protected function __construct() {
            parent::__construct();
        }

        public function getCount(DVDQueryModel $queryModel = null):int
        {
            $queryBuilder = (new QueryBuilder())
                ->select("Count(id)")
                ->from("dvds");
            if($queryModel)
            {
                if($queryModel->IsOffered !== null)
                {
                    $queryBuilder->where("IsOffered", "=", $queryModel->IsOffered);
                }

                if($queryModel->Search !== null)
                {
                    $queryBuilder->where("Title", "LIKE", "%" . $queryModel->Search. "%");
                    $queryBuilder->where("LocalTitle", "LIKE", "%" . $queryModel->Search. "%");
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

        public function getAll(DVDQueryModel $queryModel): array
        {
            $result = array();
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "Title", "LocalTitle", "Synopsis", "Notation", "Note", "Certification", "IsOffered", "Quantity", "Price", "Year"])
                ->from("dvds")
                ->limit($queryModel->Offset, $queryModel->Limit);

            if($queryModel->IsOffered !== null)
            {
                $queryBuilder->where("IsOffered", "=", $queryModel->IsOffered);
            }

            if($queryModel->Search !== null)
            {
                $queryBuilder->where("Title", "LIKE", "%" . $queryModel->Search. "%");
                $queryBuilder->where("LocalTitle", "LIKE", "%" . $queryModel->Search. "%");
            }

            if($queryModel->OrderBy !== null &&
                $queryModel->OrderBy !== "" &&
                $this->isAllowedOrderColumn($queryModel->OrderBy))
            {
                $queryBuilder->orderBy($queryModel->OrderBy, $queryModel->OrderDesc);
            }

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

        public function getById($id):?DVDModel
        {
            $result = array();
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "Title", "LocalTitle", "Synopsis", "Notation", "Note", "Certification", "IsOffered", "Quantity", "Price", "Year"])
                ->from("dvds")
                ->where("Id", "=", $id);

            $query = $queryBuilder->getQuery();

            $queryResult = $this->fetchStatement($query->sql, $query->params, DVDModel::class);

            if($queryResult )
            {
                return $queryResult;
            }

            return null;
        }

        public function update(DVDModel $dvd)
        {
            $queryBuilder = (new UpdateQueryBuilder())
                ->update("dvds")
                ->set("Title", $dvd->Title)
                ->set("LocalTitle", $dvd->LocalTitle)
                ->set("Synopsis", $dvd->Synopsis)
                ->set("Notation", $dvd->Notation)

                ->where("Id", "=", $dvd->Id);

            $query = $queryBuilder->getQuery();

            $queryResult = $this->fetchStatement($query->sql, $query->params, DVDModel::class);
        }

        function isAllowedOrderColumn(string $column): bool
        {
            $allowedOrderColumns = array("Quantity", "Year", "Title", "IsOffered", "Price");
            return in_array($column, $allowedOrderColumns);
        }
    }
}

