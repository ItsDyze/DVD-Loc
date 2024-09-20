<div id="cart-nav" class="cart-nav" >
    <a id="closeCart" href="#" class="close" onclick="toggleCart()">×</a>
    <div id="cart-content">
        <ul>
            <?php
            if(isset($_COOKIE["cart"]))
            {
                $cart = json_decode($_COOKIE["cart"]);
                foreach($cart->articles as $article):
                    ?>
                    <li class="cart-item">
                        <a href="/dvd/<?php echo $article->id; ?>"><?php echo $article->name; ?></a>
                        <div class="cart-remove" onclick="removeFromCart(<?php echo $article->id; ?>)">
                            retirer
                        </div>
                    </li>


                <?php endforeach;
            }

            ?>
        </ul>
    </div>
</div>

<a href="#" id="openCart" onclick="toggleCart()">
    <img alt="cart icon" src="/assets/cart.svg" width="32px" height="32px"/>
</a>

<div id="cart-backdrop" class="backdrop" onclick="toggleCart()">

</div>