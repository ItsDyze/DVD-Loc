<?php
namespace Models\ViewModels
{

    enum LoginViewStateEnum
    {
        case InProgress;
        case FailedServer;
        case Success;
        case Logout;
    }
}
