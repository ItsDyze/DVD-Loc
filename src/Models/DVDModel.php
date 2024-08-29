<?php

namespace Models
{
    class DVDModel
    {
        public int $Id;
        public ?string $Title;
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
        public ?string $ImageBase64;
        public ?string $ImageSignature;

        public ?array $Genres;
    }
}

