<?php namespace Views\Home; ?>

<style>
<?php include ASSETS . 'styles.css'; ?>
<?php include 'Layout.css'; ?>
</style>
<header>
    <h1><?php echo $title; ?></h1>
    <div class="login-btn" onClick="document.location.href='/Auth/Login'">
        Login
    </div>
</header>
<main>
    <?php include $view; ?>
</main>
<footer>
    <p>Footer content here</p>
</footer>