<?php

namespace Services
{

    use Models\DVDLightModel;
    use Models\DVDModel;
    use Models\QueryModel\BaseQueryModel;
    use Utils\Query\InsertQueryBuilder;
    use Utils\Query\QueryBuilder;
    use Utils\Query\UpdateQueryBuilder;
    use Utils\PHPUtils;

    class DVDService extends DataService
    {

        protected function __construct() {
            parent::__construct();
        }

        public function getCount($isOffered = null, BaseQueryModel $queryModel = null):int
        {
            $queryBuilder = (new QueryBuilder())
                ->select("Count(id)")
                ->from("dvds");

            if($isOffered !== null)
            {
                $queryBuilder->where("IsOffered", "=", $isOffered);
            }

            if($queryModel && !PHPUtils::IsNullOrEmpty($queryModel->Search))
            {
                $queryBuilder->where("UPPER(LocalTitle)", "LIKE", strtoupper($queryModel->Search));
            }

            $query = $queryBuilder->getQuery();
            $queryResult = $this->fetchValue($query->sql, $query->params);

            if($queryResult)
            {
                return $queryResult;
            }

            return 0;
        }

        public function getAll(BaseQueryModel $queryModel, $isOffered = null): array
        {
            $result = array();
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "LocalTitle", "Notation", "Certification", "IsOffered", "Quantity", "Price", "Year", "Image", "TypeId", "GenreId"])
                ->from("dvds")
                ->limit($queryModel->Offset, $queryModel->Limit);

            if($isOffered !== null)
            {
                $queryBuilder->where("IsOffered", "=", $isOffered);
            }

            if(!PHPUtils::IsNullOrEmpty($queryModel->Search))
            {
                $queryBuilder->where("UPPER(LocalTitle)", "LIKE", strtoupper($queryModel->Search));
            }

            if(!PHPUtils::IsNullOrEmpty($queryModel->OrderBy) &&
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

        public function getHighlights($isPreview, BaseQueryModel $queryModel = null): array
        {
            if($isPreview)
            {
                $queryModel = new BaseQueryModel();
                $queryModel->OrderBy = "Notation";
                $queryModel->OrderDesc = true;
                $queryModel->Limit = 10;
                $queryModel->Offset = 0;
            }

            $result = array();
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "LocalTitle", "Notation", "Certification", "IsOffered", "Quantity", "Price", "Year", "Image", "TypeId", "GenreId"])
                ->from("dvds")
                ->where("IsOffered", "=", 1)
                ->limit($queryModel->Offset, $queryModel->Limit);


            if(!PHPUtils::IsNullOrEmpty($queryModel->Search))
            {
                $queryBuilder->where("UPPER(LocalTitle)", "LIKE", strtoupper($queryModel->Search));
            }

            if(!PHPUtils::IsNullOrEmpty($queryModel->OrderBy) &&
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

        public function getByGenre($genreId): array
        {
            $queryModel = new BaseQueryModel();
            $queryModel->OrderBy = "Notation";
            $queryModel->OrderDesc = true;
            $queryModel->Limit = 10;
            $queryModel->Offset = 0;

            $result = array();
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "LocalTitle", "Notation", "Certification", "IsOffered", "Quantity", "Price", "Year", "Image", "TypeId", "GenreId"])
                ->from("dvds")
                ->where("GenreId", "=", $genreId)
                ->limit($queryModel->Offset, $queryModel->Limit);



            if(!PHPUtils::IsNullOrEmpty($queryModel->OrderBy) &&
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

        public function getByType($typeId): array
        {
            $queryModel = new BaseQueryModel();
            $queryModel->OrderBy = "Notation";
            $queryModel->OrderDesc = true;
            $queryModel->Limit = 10;
            $queryModel->Offset = 0;

            $result = array();
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "LocalTitle", "Notation", "Certification", "IsOffered", "Quantity", "Price", "Year", "Image", "TypeId", "GenreId"])
                ->from("dvds")
                ->where("TypeId", "=", $typeId)
                ->limit($queryModel->Offset, $queryModel->Limit);



            if(!PHPUtils::IsNullOrEmpty($queryModel->OrderBy) &&
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

        public function getMostPopularGenres()
        {
            $result = array();
            $query = "SELECT d.GenreId as Id, g.Name, COUNT(d.Id) ".
                        "FROM dvds d " .
                        "JOIN genres g ON g.Id = d.GenreId " .
                        "WHERE IsOffered = 1 ".
                        "GROUP BY d.GenreId, g.Name ".
                        "ORDER BY COUNT(d.Id) DESC " .
                        "LIMIT 5";

            $queryResult = $this->fetchAllStatement($query, []);

            if($queryResult && count($queryResult) > 0)
            {
                foreach($queryResult as $row)
                {
                    $result[] = $row;
                }
            }

            return $result;
        }

        public function getMostPopularTypes()
        {
            $result = array();
            $query = "SELECT d.TypeId as Id, t.Name, COUNT(d.Id) ".
                "FROM dvds d " .
                "JOIN types t ON t.Id = d.TypeId " .
                "WHERE IsOffered = 1 ".
                "GROUP BY d.TypeId, t.Name ".
                "ORDER BY COUNT(d.Id) DESC " .
                "LIMIT 5";

            $queryResult = $this->fetchAllStatement($query, []);

            if($queryResult && count($queryResult) > 0)
            {
                foreach($queryResult as $row)
                {
                    $result[] = $row;
                }
            }

            return $result;
        }

        public function getById($id)
        {
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "Title", "LocalTitle", "Synopsis", "Notation", "Note", "Certification", "IsOffered", "Quantity", "Price", "Year", "Image", "TypeId", "GenreId"])
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

        public function getLightModelById($id)
        {
            $result = array();
            $queryBuilder = (new QueryBuilder())
                ->select(["Id", "LocalTitle", "Synopsis", "Notation", "Note", "Certification", "Quantity", "Price", "Year", "Image", "TypeId", "GenreId"])
                ->from("dvds")
                ->where("Id", "=", $id);

            $query = $queryBuilder->getQuery();

            $queryResult = $this->fetchStatement($query->sql, $query->params, DVDLightModel::class);

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
                ->set("GenreId", $dvd->GenreId)

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
                ->value("TypeId", $dvd->TypeId)
                ->value("GenreId", $dvd->GenreId);

            $query = $queryBuilder->getQuery();

            return $this->insertStatement($query->sql, $query->params);
        }

        function isAllowedOrderColumn(string $column): bool
        {
            $allowedOrderColumns = array("Quantity", "Year", "Title", "IsOffered", "Price", "Notation");
            return in_array($column, $allowedOrderColumns);
        }
    }
}

