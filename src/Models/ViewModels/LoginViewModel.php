<?php
namespace Models\ViewModels
{

    use Interfaces\IViewModel;

    class LoginViewModel implements IViewModel
    {

        public LoginViewStateEnum $viewState;
    }
}
