<?php

/**
 * @var AccountViewModel $data
 */

use Models\ViewModels\AccountViewModel;
use Utils\ComponentsUtils;

$user = $data->User;

$componentBuilder = new ComponentsUtils();

?>

<h2>
    Bienvenue <?php echo $data->User->getDisplayName(); ?>
</h2>

<form class="account-detail" method="POST">
    <h3>
        Informations générales
    </h3>
    <div class="account-section">
        <?php echo $componentBuilder->getTextComponent("LastName", "Nom", "Nom", $user->LastName, true, false); ?>
        <?php echo $componentBuilder->getTextComponent("FirstName", "Prénom", "Prénom", $user->FirstName, true, false); ?>
    </div>
    <div class="account-section">
        <?php echo $componentBuilder->getEmailComponent("Email", "Email", "Email", $user->Email, true, false); ?>
    </div>
    <h3>
        Adresse
    </h3>
    <div class="account-section">

        <?php echo $componentBuilder->getTextComponent("PostCode", "Code postal", "Code postal", $user->PostCode??"", true, false); ?>
        <?php echo $componentBuilder->getTextComponent("City", "Ville", "Ville", $user->City??"", true, false); ?>
    </div>
    <div class="account-section">
        <?php echo $componentBuilder->getTextComponent("AddressLine", "Rue et numéro", "Rue et numéro", $user->AddressLine??"", true, false); ?>
    </div>
    <h3>
        Securité
    </h3>
    <div class="account-section">

        <label>
            <span>Changer le mot de passe</span>
            <input type="password" name="Password" placeholder="Mot de passe">
        </label>
    </div>
    <button type="submit">Save</button>
</form>

