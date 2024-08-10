<?php
namespace Models
{

    use Interfaces\IViewModel;

    class LoginViewModel implements IViewModel
    {

        public LoginViewStateEnum $viewState;
    }
}
