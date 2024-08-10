<?php
namespace Models
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


