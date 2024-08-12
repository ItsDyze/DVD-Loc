<?php
namespace Models
{
    class JWTModel
    {
        public string $iat;
        public string $nbf;
        public string $exp;
        public string $displayName;
        public bool $isAdmin;
    }
}