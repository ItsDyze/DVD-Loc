<?php namespace Models; ?>
<?php

class RegisterViewModel 
{
    public RegisterViewStateEnum $viewState;
}

enum RegisterViewStateEnum
{
    case InProgress;
    case FailedServer;
    case FailedValidation;
    case Success;
}

?>