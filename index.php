<?php

use Blog\Controller;
require('controller/PostsController.php');

$postController = new Blog\Controller\PostsController();

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listPosts') 
    {
        $postController->listPosts();
    }
    elseif ($_GET['action'] === 'post') 
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) 
        {
            $postController->onePost($_GET['id']);
        }
        else 
        {
            echo '<p>Erreur : aucun identifiant de billet envoyé</p>';
        }
    }
    elseif ($_GET['action'] === 'addPost')
    {
        if(!empty($_POST['title']) && !empty($_POST['content']))
        {
            $postController->addPost($_POST['title'], $_POST['content']);
        }
        else
        {
            echo "<p>Erreur : tous les champs ne sont pas remplis.</p>";
        }
    }
    elseif ($_GET['action'] === 'connexion')
    {
        if(!empty($_POST['login']) && !empty($_POST['password']))
        {
            $postController->login($_POST['title'], $_POST['password']);
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