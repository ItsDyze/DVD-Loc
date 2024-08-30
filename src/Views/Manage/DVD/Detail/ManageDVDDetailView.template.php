<?php

namespace Views\Manage\DVD\Detail;
use Models\ViewModels\ManageDVDDetailViewStateEnum;
use Utils\Components\ComponentsEnum;
use Utils\ComponentsUtils;

$componentBuilder = new ComponentsUtils();
$action = match ($data->state)
{
    ManageDVDDetailViewStateEnum::Create => "POST",
    ManageDVDDetailViewStateEnum::Update => "PUT",
    default => ""
};

?>
<h2>
    🎬 <?php echo $data->DVD->LocalTitle; ?> 🎬
</h2>
<a class="custom-link" onclick="history.back()">Back to the list</a>

<form method="POST" action="" class="container">
    <div class="side-nav section-block">
        <a href="#General">General</a>
        <a href="#Avis">Avis</a>
        <a href="#Reglementaire">Informations réglementaires</a>
        <a href="#Commerciales">Informations commerciales</a>
        <a href="#Credits">Crédits</a>
        <a href="#Commandes">Commandes</a>
    </div>
    <div class="form section-block">
        <div>
            <h3 id="General">General</h3>
            <input type="hidden" name="_METHOD" value="<?php echo $action; ?>"/>
            <input type="hidden" name="Genres" />
            <input type="hidden" name="TypeId" />
            <?php echo $componentBuilder->getTextComponent("Title", "Titre", "Titre", $data->DVD->Title, true, false); ?>
            <?php echo $componentBuilder->getTextComponent("LocalTitle", "Titre local", "Titre local", $data->DVD->LocalTitle, true, false); ?>
            <?php echo $componentBuilder->getAreaComponent("Synopsis", "Synopsis", "Synopsis", $data->DVD->Synopsis, true, false); ?>
            <?php echo $componentBuilder->getNumberComponent("Year", "Année de sortie", $data->DVD->Year, 1800, 2500, 1, false, false); ?>
            <?php
                echo $componentBuilder->getImageComponent("Image", "Image", $data->DVD->Image, false, false);
            ?>
        </div>
        <div>
            <h3 id="Avis">Avis</h3>
            <?php echo $componentBuilder->getNumberComponent("Notation", "Note", $data->DVD->Notation, 0, 5, 1, false, false); ?>
            <?php echo $componentBuilder->getAreaComponent("Note", "Note du vendeur", "Note du vendeur", $data->DVD->Note, false, false); ?>
        </div>
        <div>
            <h3 id="Reglementaire">Informations réglementaires</h3>
            <?php echo $componentBuilder->getTextComponent("Certification", "Restrictions", "Restrictions", $data->DVD->Certification, false, false); ?>
        </div>
        <div>
            <h3 id="Commerciales">Informations commerciales</h3>
            <?php echo $componentBuilder->getNumberComponent("Price", "Prix", $data->DVD->Price, 0, 9999, .01, false, false); ?>
            <?php echo $componentBuilder->getNumberComponent("Quantity", "Quantité", $data->DVD->Quantity, 0, 9999, 1, false, false); ?>
            <?php echo $componentBuilder->getToggleComponent("IsOffered", "Est dans l'offre", $data->DVD->IsOffered, false, false); ?>
        </div>
        <div>
            <h3 id="Credits">Credits</h3>
            Acteurs etc
        </div>
        <div>
            <h3 id="Commandes">Etat des DVD en commandes</h3>
            X commandés
            Y chez le client
            Z perdus
        </div>

        <button type="submit">Save</button>
    </div>
</form>
