<?php

namespace Models;

class DVDCollection
{
    public string $Name;
    public CollectionTypeEnum $CollectionType;
    public int $Order;
    public array $DVDs;
}

