<?php

namespace Controllers\DVD;

use Models\DVDLightModel;
use Models\ViewModels\DVDViewModel;
use Services\DVDService;
use Views\DVD\DVDView;

class DVDController
{
    public function get($id)
    {
        $data = new DVDViewModel();
        $service = DVDService::getInstance();

        $data->dvd = $service->getLightModelById($id);

        $view = new DVDView($data);
        $view->render();
    }
}