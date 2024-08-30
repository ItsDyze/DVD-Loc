<?php

namespace Services
{

    use Exception;
    use Models\DVDModel;
    use Models\QueryModel\DVDQueryModel;
    use Utils\Query\InsertQueryBuilder;
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
                ->select(["Id", "LocalTitle", "Notation", "Certification", "IsOffered", "Quantity", "Price", "Year", "Image", "TypeId"])
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
                ->select(["Id", "Title", "LocalTitle", "Synopsis", "Notation", "Note", "Certification", "IsOffered", "Quantity", "Price", "Year", "Image", "TypeId"])
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
                ->set("Certification", $dvd->Certification)
                ->set("Note", $dvd->Note)
                ->set("IsOffered", $dvd->IsOffered)
                ->set("Quantity", $dvd->Quantity)
                ->set("Price", $dvd->Price)
                ->set("Year", $dvd->Year)
                ->set("Image", $dvd->Image)
                ->set("TypeId", $dvd->TypeId)

                ->where("Id", "=", $dvd->Id);

            $query = $queryBuilder->getQuery();

            $queryResult = $this->fetchStatement($query->sql, $query->params, DVDModel::class);
        }

        public function insert(DVDModel $dvd)
        {
            $queryBuilder = (new InsertQueryBuilder())
                ->insert("dvds")
                ->value("Title", $dvd->Title)
                ->value("LocalTitle", $dvd->LocalTitle)
                ->value("Synopsis", $dvd->Synopsis)
                ->value("Notation", $dvd->Notation)
                ->value("Certification", $dvd->Certification)
                ->value("Note", $dvd->Note)
                ->value("IsOffered", $dvd->IsOffered)
                ->value("Quantity", $dvd->Quantity)
                ->value("Price", $dvd->Price)
                ->value("Year", $dvd->Year)
                ->value("Image", $dvd->Image)
                ->value("TypeId", $dvd->TypeId);

            $query = $queryBuilder->getQuery();

            return $this->insertStatement($query->sql, $query->params);
        }

        function isAllowedOrderColumn(string $column): bool
        {
            $allowedOrderColumns = array("Quantity", "Year", "Title", "IsOffered", "Price");
            return in_array($column, $allowedOrderColumns);
        }
    }
}

