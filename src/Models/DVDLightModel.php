<?php

namespace Models;

class DVDLightModel
{
    public int $Id;
    public ?string $LocalTitle;
    public ?string $Synopsis;
    public ?int $Notation;
    public ?string $Note;
    public ?string $Certification;
    public ?bool $IsOffered;
    public ?int $Quantity;
    public ?float $Price;
    public ?int $Year;
    public ?string $Image;
    public ?int $TypeId;
    public ?string $Type;
    public ?array $Genres;
}