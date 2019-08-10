<?php
require_once('auth.php');
authenticatedUser();
use \Blog\Admin\Controller;

require('controller/AdminPostsController.php');

$postController = new Blog\Admin\Controller\AdminPostsController();

if (isset($_GET['action'])) {
    switch ($_GET['action'])
    {
        case 'listPosts': 
            $postController->listPosts();
            break;

        case 'post':
            if (isset($_GET['id']) AND $_GET['id'] > 0) 
            {
                $postController->onePost($_GET['id']);
            }
            else 
            {
                echo '<p>Erreur : aucun identifiant de billet envoyé</p>';
            }
            break;

        case 'addPost':
            if(!empty($_POST['title']) AND !empty($_POST['content']))
            {
                $postController->addPost($_POST['title'], $_POST['content']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;

        case 'connexion':
            if(!empty($_POST['login']) AND !empty($_POST['password']))
            {
                $postController->login($_POST['title'], $_POST['password']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;

        case 'modifyPost':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $postController->modifyPost();
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
            }
            break;

        case 'updatePost':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $postController->updatePost($_POST['title'], $_POST['content'], $_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
            }
            break;

        case 'removePost':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $postController->removePost($_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
            }
            break;

        case 'addComment':
            if (!empty($_POST['author']) AND !empty($_POST['comment']))
            {
                $postController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;

        case 'notifyComment':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $postController->reportComment($_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de commentaire envoyé"; 
            }
            break;

        case 'removeComment':
            if (isset($_GET['id']) AND $_GET['id'] > 0)
            {
                $postController->removeComment($_GET['id']);
            }
            else
            {
                echo "<p>Erreur : aucun identifiant de commentaire envoyé";
            }

    }
}

else 
{
    $postController->listPosts();
}