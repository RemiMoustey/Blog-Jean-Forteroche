<?php

use \Blog\Admin\Controller;

require('controller/AdminPostsController.php');

$postController = new Blog\Admin\Controller\AdminPostsController();

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
    elseif ($_GET['action'] === 'modifyPost')
    {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            $postController->modifyPost();
        }
        else
        {
            echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
        }
    }
    elseif ($_GET['action'] === 'updatePost')
    {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            $postController->updatePost($_POST['title'], $_POST['content']);
        }
        else
        {
            echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
        }
    }
    elseif ($_GET['action'] === 'removePost')
    {
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            $postController->removePost($_GET['id']);
        }
        else
        {
            echo "<p>Erreur : aucun identifiant de billet envoyé.</p>";
        }
    }
    elseif ($_GET['action'] === 'addComment')
    {
        if(!empty($_POST['author']) && !empty($_POST['comment']))
        {
            $postController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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