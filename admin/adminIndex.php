<?php
require_once('auth.php');
authenticatedUser();
use \Blog\Controller;

require('../controller/AdminController.php');

$adminController = new Blog\Controller\AdminController();

if (isset($_GET['action'])) {
    switch ($_GET['action'])
    {
        case 'listPosts': 
            $adminController->listPosts();
            break;

        case 'post':
            if (isset($_GET['id']) AND $_GET['id'] > 0) 
            {
                $adminController->onePost($_GET['id']);
            }
            else 
            {
                echo '<p>Erreur : aucun identifiant de billet envoyé</p>';
            }
            break;

        case 'addPost':
            if(!empty($_POST['title']) AND !empty($_POST['content']))
            {
                $adminController->addPost($_POST['title'], $_POST['content']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;

        case 'connexion':
            if(!empty($_POST['login']) AND !empty($_POST['password']))
            {
                $adminController->login($_POST['title'], $_POST['password']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;

        case 'modifyPost':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $adminController->modifyPost();
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
            }
            break;

        case 'updatePost':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $adminController->updatePost($_POST['title'], $_POST['content'], $_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
            }
            break;

        case 'removePost':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $adminController->removePost($_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
            }
            break;

        case 'addComment':
            if (!empty($_POST['author']) AND !empty($_POST['comment']))
            {
                $adminController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;

        case 'notifyComment':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $adminController->reportComment($_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de commentaire envoyé"; 
            }
            break;

        case 'removeComment':
            if (isset($_GET['id']) AND $_GET['id'] > 0 AND isset($_GET['post_id']) AND $_GET['post_id'] > 0)
            {
                $adminController->removeComment($_GET['id'], $_GET['post_id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de commentaire envoyé";
            }
    }
}

else 
{
    $adminController->listPosts();
}