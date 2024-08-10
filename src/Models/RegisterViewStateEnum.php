<?php

namespace Models
{
    enum RegisterViewStateEnum
    {
        case InProgress;
        case FailedServer;
        case FailedValidation;
        case Success;
    }
}

