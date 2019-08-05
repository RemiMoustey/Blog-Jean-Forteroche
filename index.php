<?php

use Blog\Controller;
require('controller/PostsController.php');

$postController = new Blog\Controller\PostsController();

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listPosts') {
        $postController->listPosts();
    }
    elseif ($_GET['action'] === 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postController->onePost($_GET['id']);
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
}

else {
    $postController->listPosts();
}