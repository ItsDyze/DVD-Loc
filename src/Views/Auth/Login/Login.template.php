<?php namespace Views\Auth\Login ?>


<div>
    <h2>
        Vous avez déjà un compte? Connnectez-vous ci-dessous!
    </h2>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <a href="/Auth/Register">Pas de compte? C'est par ici!</a>

</div>

