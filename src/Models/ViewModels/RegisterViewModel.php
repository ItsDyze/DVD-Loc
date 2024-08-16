<?php
namespace Models\ViewModels
{

    use Interfaces\IViewModel;

    class RegisterViewModel implements IViewModel
    {
        function __construct()
        {

        }
        public RegisterViewStateEnum $viewState;
    }

}


