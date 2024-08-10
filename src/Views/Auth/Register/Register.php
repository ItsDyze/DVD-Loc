<?php namespace Views\Auth\Register; ?>
<?php
    


    class RegisterView 
    {


        public function __construct(RegisterViewModel $model) 
        {
            include "Register.template.php";
        }


    }
?>