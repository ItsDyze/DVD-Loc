<?php namespace Models; ?>
<?php

class UserModel
{
    public string $LastName;
    public string $FirstName;
    public string $Email;
    public string $Password;

    public function getDisplayName(): string
    {
        return $this->FirstName . ' ' . $this->LastName;
    }
}

