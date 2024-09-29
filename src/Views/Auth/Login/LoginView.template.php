<?php
/**
 * @var LoginViewModel $data
 */

use Models\ViewModels\LoginViewModel;
use Models\ViewModels\LoginViewStateEnum;

switch ($data->viewState)
{
    case LoginViewStateEnum::Success:
        echo "Vous êtes connectés avec succès.";
        ?>
        <br/>Vous allez être automatiquement redirigé après 2 secondes. <a href="/home">Je suis pressé!</a>
        <script>
            setTimeout(()=>{document.location.href="/home"}, 1000);
        </script>
        <?php
        break;
    case LoginViewStateEnum::Logout:
        echo "Déconnecté avec succès.";
        ?>
        <br/>Vous allez être automatiquement redirigé après 2 secondes. <a href="/auth/login">Je suis pressé!</a>
        <script>
            setTimeout(()=>{document.location.href="/auth/login"}, 1000);
        </script>
        <?php
        break;
    case LoginViewStateEnum::FailedServer:
    case LoginViewStateEnum::InProgress:
    default:
        ?>
        <div class="sub-page">
            <h2>
                Vous avez déjà un compte? Connnectez-vous ci-dessous!
            </h2>
            <a href='/auth/register'>Pas de compte? C'est par ici!</a>
            <?php
            if($data->viewState == LoginViewStateEnum::FailedServer) echo "Impossible de vous connecter avec ces identifiants!<br/>";
            ?>
            <form method="POST" action="">
                <label>
                    <span>Email</span>
                    <input type="email" name="email" placeholder="Email" required>
                </label>
                <label>
                    <span>Mot de passe</span>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                </label>
                <button type="submit">Connexion</button>
            </form>


        </div>

        <?php
        break;
}
?>