<?php

namespace Models\ViewModels;

use Interfaces\IViewModel;
use Models\UserModel;

class AccountViewModel implements IViewModel
{
    public UserModel $User;
}