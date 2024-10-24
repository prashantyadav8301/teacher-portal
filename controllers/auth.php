<?php
// Redirect to dashboard if user is already logged in
function isLoggedIn()
{
    return isset($_SESSION['login_user']);
}

// Protect routes by checking if the user is logged in
function protectRoute()
{
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

// Prevent access to login/register pages if already logged in
function redirectIfAuthenticated()
{
    if (isLoggedIn()) {
        header("Location: index.php");
        exit();
    }
}
