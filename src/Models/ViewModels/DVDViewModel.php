<?php

namespace Models\ViewModels;

use Interfaces\IViewModel;
use Models\DVDLightModel;

class DVDViewModel implements IViewModel{
    public DVDLightModel $dvd;
}