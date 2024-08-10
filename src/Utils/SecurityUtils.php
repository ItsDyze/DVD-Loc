<?php namespace Utils; ?>
<?php

class SecurityUtils
{

    public static function HashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

}

?>