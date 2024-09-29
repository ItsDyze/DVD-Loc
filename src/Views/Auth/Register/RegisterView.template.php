<?php

use Models\ViewModels\RegisterViewStateEnum;
use Utils\ComponentsUtils;

$componentBuilder = new ComponentsUtils();

switch ($this->data->viewState)
    {
        case RegisterViewStateEnum::FailedValidation:
            echo "Les données saisies sont incorrectes.";
            break;
        case RegisterViewStateEnum::FailedServer:
            echo "Impossible de vous enregistrer. Veuillez réessayer plus tard.";
            break;
        case RegisterViewStateEnum::Success:
            echo "Enregistré avec succès.";
            ?>
            <br/>Vous allez être automatiquement redirigé après 2 secondes. <a href="/login">Je suis pressé!</a>
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
    <?php echo $componentBuilder->getTextComponent("LastName", "Nom", "Nom", "", true, false); ?>
    <?php echo $componentBuilder->getTextComponent("FirstName", "Prénom", "Prénom", "", true, false); ?>
    <?php echo $componentBuilder->getEmailComponent("Email", "Email", "Email", "", true, false); ?>
    <?php echo $componentBuilder->getTextComponent("PostCode", "Code postal", "Code postal", "", true, false); ?>
    <?php echo $componentBuilder->getTextComponent("City", "Ville", "Ville", "", true, false); ?>
    <?php echo $componentBuilder->getTextComponent("AddressLine", "Rue et numéro", "Rue et numéro", "", true, false); ?>

    <label>
        <span>Mot de passe</span>
        <input type="password" name="Password" placeholder="Mot de passe" required>
    </label>
    <button type="submit">Register</button>
</form>
<?php
        break;
        }
?>