<?php

use Models\ViewModels\RegisterViewStateEnum;

switch ($this->data->viewState)
    {
        case RegisterViewStateEnum::FailedValidation:
            echo "Provided input is not valid.";
            break;
        case RegisterViewStateEnum::FailedServer:
            echo "We couldn't register you right now, please try again later.";
            break;
        case RegisterViewStateEnum::Success:
            echo "You have successfully registered.";
            ?>
            <br/>Vous allez être automatiquement redirigé après 2 secondes. <a href="login">Je suis pressé!</a>
            <script>
                setTimeout(()=>{document.location.href="login"}, 2000);
            </script>
            <?php
            break;
        case RegisterViewStateEnum::InProgress:
        default:
?>
<form method="POST" action="" class="sub-page">
    <h2>Register here!</h2>
    <label>
        <span>Last name</span>
        <input type="text" name="LastName" placeholder="Last name" required>
    </label>
    <label>
        <span>First name</span>
        <input type="text" name="FirstName" placeholder="First Name" required>
    </label>
    <label>
        <span>Email</span>
        <input type="email" name="Email" placeholder="Email" required>
    </label>
    <label>
        <span>Password</span>
        <input type="password" name="Password" placeholder="Password" required>
    </label>
    <button type="submit">Register</button>
</form>
<?php
        break;
        }
?>