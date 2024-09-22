<?php

namespace Models\ViewModels;

use Interfaces\IViewModel;
use Models\DVDLightModel;
use Models\QueryModel\ManageDVDQueryModel;

class SearchViewModel implements IViewModel{
    public array $DVDs;
    public int $FilteredCount;
    public ManageDVDQueryModel $Query;
    public int $TotalPages;
    public int $CurrentPage;
}