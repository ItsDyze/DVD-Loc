<?php

use Utils\JWTUtils;

function authMiddleware($admin = false): void
{
    if (empty($_COOKIE['jwt'])) {
        // Redirect to the login page if the user is not authenticated
        header('Location: /auth/login');
        exit;
    }

    // Decode the JWT token to get user information
    $jwt = JWTUtils::decode($_COOKIE['jwt']);

    // If a specific role is required, check if the user has that role
    if ($admin && !(isset($jwt->isAdmin) && $jwt->isAdmin)) {
        // Redirect to an unauthorized page or show an error
        header('Location: /auth/error');
        exit;
    }
}