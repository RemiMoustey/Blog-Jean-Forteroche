<?php
function isAuthenticated()
{
    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }
    return !empty($_SESSION['authenticated']);
}

function authenticatedUser()
{
    if(!isAuthenticated())
    {
        header('Location: ../index.php?action=login');
        exit();
    }
}