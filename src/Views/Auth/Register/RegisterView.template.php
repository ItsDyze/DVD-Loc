<style>
    <?php require "RegisterView.style.php"; ?>
</style>

<form method="POST" action="">
    <label>
        Last name
        <input type="text" name="LastName" placeholder="Last name" required>
    </label>
    <label>
        First name
        <input type="text" name="FirstName" placeholder="First Name" required>
    </label>
    <label>
        Email
        <input type="email" name="Email" placeholder="Email" required>
    </label>
    <label>
        Password
        <input type="password" name="Password" placeholder="Password" required>
    </label>
    <button type="submit">Register</button>
</form>