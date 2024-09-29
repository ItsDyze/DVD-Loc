<?php

namespace Models;

class UserModel
{
    public int $Id;
    public string $LastName;
    public string $FirstName;
    public string $City;
    public string $PostCode;
    public string $AddressLine;
    public string $Email;
    public string $Password;

    public function getDisplayName(): string
    {
        return $this->FirstName . ' ' . $this->LastName;
    }
}

