<h2>
    <?php
        echo $data->dvd->LocalTitle;
    ?>
</h2>
<div class="button" onclick="addToCart(<?php echo $data->dvd->Id; ?>, '<?php echo $data->dvd->LocalTitle; ?>')">
    <img alt="cart icon" src="/assets/add-to-cart.svg" width="32px" height="32px"/>
</div>
<div class="product-detail">
    <div class="summary">
        <img src="<?php echo $data->dvd->Image;  ?>" class="img-preview"/>
        <div>
            <?php
            echo $data->dvd->Synopsis;
            ?>
        </div>
    </div>

    <div class="details">

        <div>
            <h3>
                Prix location
            </h3>
            <?php echo $data->dvd->Price; ?> €
        </div>
        <div>
            <h3>
                Note
            </h3>
            Noté <?php echo $data->dvd->Notation; ?>/5 sur IMDB
        </div>
        <div>
            <h3>
                Année de sortie
            </h3>
            <?php echo $data->dvd->Year; ?>
        </div>
        <div>
            <h3>
                Public
            </h3>
            Evalué: <?php echo $data->dvd->Certification; ?>
        </div>

        <div>
            <h3>
                La remarque du chef
            </h3>
            <?php echo $data->dvd->Note; ?>
        </div>
    </div>


</div>

