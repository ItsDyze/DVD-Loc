<?php
namespace Models
{

    enum LoginViewStateEnum
    {
        case InProgress;
        case FailedServer;
        case Success;
    }
}
