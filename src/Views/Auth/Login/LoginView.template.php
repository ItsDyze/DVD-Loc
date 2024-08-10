<style>
    <?php require "LoginView.style.css"; ?>
</style>
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
    <a href="/Auth/Register">Pas de compte? C'est par ici!</a>

</div>