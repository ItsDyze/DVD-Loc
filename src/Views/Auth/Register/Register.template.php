<?php namespace Views\Auth\Register; ?>

<form method="POST" action="">
    <input type="text" name="LastName" placeholder="Last name" required>
    <input type="text" name="FirstName" placeholder="First Name" required>
    <input type="email" name="Email" placeholder="Email" required>
    <input type="password" name="Password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>