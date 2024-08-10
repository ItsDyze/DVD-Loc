<?php

use Models\RegisterViewStateEnum;

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
            <br/>Vous allez être automatiquement redirigé après 2 secondes. <a href="Login">Je suis pressé!</a>
            <script>
                setTimeout(()=>{document.location.href="Login"}, 2000);
            </script>
            <?php
            break;
        case RegisterViewStateEnum::InProgress:
        default:
?>
<form method="POST" action="">
    <label>
        Last name
        <input type="text" name="LastName" placeholder="Last name" required>
    </label>
    <label>
        First name
        <input type="text" name="FirstName" placeholder="First Name" required>
    </label>
    <label>
        Email
        <input type="email" name="Email" placeholder="Email" required>
    </label>
    <label>
        Password
        <input type="password" name="Password" placeholder="Password" required>
    </label>
    <button type="submit">Register</button>
</form>
<?php
        break;
        }
?>