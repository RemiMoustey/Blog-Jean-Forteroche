<?php

use Blog\Controller;
require('controller/Controller.php');

$controller = new Blog\Controller\Controller();

if (isset($_GET['action'])) {
    switch ($_GET['action'])
    {
        case 'listPosts':
            $controller->listPosts();
            break;

        case 'post': 
            if (isset($_GET['id']) AND $_GET['id'] > 0) 
            {
                $controller->onePost($_GET['id']);
            }
            else 
            {
                echo '<p>Erreur : aucun identifiant de billet envoyé</p>';
            }
            break;

        case 'addComment':
            if(!empty($_POST['author']) AND !empty($_POST['comment']))
            {
                $controller->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;
        
        case 'connexion':
            if(!empty($_POST['login']) AND !empty($_POST['password']))
            {
                $controller->login($_POST['login'], $_POST['password']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;

        case 'notifyComment':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $controller->reportComment($_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de commentaire envoyé"; 
            }
            break;

        case 'login':
            $controller->login();

    }
}

else {
    $controller->listPosts();
}