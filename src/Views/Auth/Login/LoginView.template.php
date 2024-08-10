<?php

use Models\LoginViewStateEnum;

switch ($this->data->viewState)
{
    case LoginViewStateEnum::Success:
        echo "You have logged in successfully.";
        ?>
        <br/>Vous allez être automatiquement redirigé après 2 secondes. <a href="Login">Je suis pressé!</a>
        <script>
            console.log("hi")
            setTimeout(()=>{document.location.href="/Home"}, 2000);
        </script>
        <?php
        break;
    case LoginViewStateEnum::FailedServer:
    case LoginViewStateEnum::InProgress:
    default:
        ?>
        <div>
            <h2>
                Vous avez déjà un compte? Connnectez-vous ci-dessous!
            </h2>
            <form method="POST" action="">
                <label>
                    Email
                    <input type="email" name="email" placeholder="Email" required>
                </label>
                <label>
                    Password
                    <input type="password" name="password" placeholder="Password" required>
                </label>
                <button type="submit">Register</button>
            </form>
            <?php
                if($this->data->viewState == LoginViewStateEnum::FailedServer) echo "We couldn't log you in using these credentials! <br/>";
            ?>
            <a href="/Auth/Register">Pas de compte? C'est par ici!</a>
        </div>

        <?php
        break;
}
?>