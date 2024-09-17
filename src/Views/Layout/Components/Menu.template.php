<div id="sidenav" class="sidenav" >
    <a id="closeBtn" href="#" class="close" onclick="toggleSidenav()">×</a>
    <ul>
        <li><a href="/">Accueil</a></li>
        <li><a href="#">Films</a></li>
        <li><a href="#">Séries</a></li>
        <?php if(!$this->layoutData->isLoggedIn)
            echo "<li><a href='/auth/login'>Se connecter</a></li>"
        ?>
        <?php if($this->layoutData->isLoggedIn && $this->layoutData->isAdmin)
            echo "<li><a href='/manage' class='sensitive'>Back office</a></li>"
        ?>
        <?php if($this->layoutData->isLoggedIn) {
            echo "<li><a href='/account'>Mon compte</a></li>";
            echo "<li><a href='/auth/logout'>Se déconnecter</a></li>";
        }
        ?>
    </ul>
</div>

<a href="#" id="openBtn">
  <span class="burger-icon" onclick="toggleSidenav()">
    <span></span>
    <span></span>
    <span></span>
  </span>
</a>

<div id="menu-backdrop" class="backdrop" onclick="toggleSidenav()">

</div>