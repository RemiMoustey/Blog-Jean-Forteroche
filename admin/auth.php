<?php
/**
  * Ce fichier vérifie si l'utilisateur est authentifié et donc, s'il a accès
  * à l'interface d'administration.
  * @author  Rémi Moustey <remimoustey@gmail.com>
  */
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
        header('Location: ../chapters.php?action=login');
        exit();
    }
}