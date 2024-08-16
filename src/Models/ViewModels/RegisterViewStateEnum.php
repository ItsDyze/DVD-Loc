<?php

namespace Models\ViewModels
{
    enum RegisterViewStateEnum
    {
        case InProgress;
        case FailedServer;
        case FailedValidation;
        case Success;
    }
}

