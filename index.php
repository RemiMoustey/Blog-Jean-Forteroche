<?php

use Blog\Controller;
require('controller/PostsController.php');

$postController = new Blog\Controller\PostsController();

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

        case 'addComment':
            if(!empty($_POST['author']) AND !empty($_POST['comment']))
            {
                $postController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
            break;
        
        case 'connexion':
            if(!empty($_POST['login']) AND !empty($_POST['password']))
            {
                $postController->login($_POST['login'], $_POST['password']);
            }
            else
            {
                echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
            }
    }
}

else {
    $postController->listPosts();
}