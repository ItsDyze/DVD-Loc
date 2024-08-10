<?php
namespace Utils
{
    class SecurityUtils
    {

        public static function hashPassword($password)
        {
            return password_hash($password, PASSWORD_BCRYPT);
        }

    }
}