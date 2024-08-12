<?php
namespace Utils
{
    class SecurityUtils
    {

        public static function hashPassword($password): string
        {
            return password_hash($password, PASSWORD_BCRYPT);
        }

    }
}