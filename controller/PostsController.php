<?php

namespace Blog\Controller;
use Blog\Model;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class PostsController
{
	public function listPosts()
	{
		$PostManager = new \Blog\Model\PostManager();
		$posts = $PostManager->getPosts();

		require('views/frontend/listPostsView.php');
	}

	public function onePost()
	{
	    $PostManager = new \Blog\Model\PostManager();
	    $CommentManager = new \Blog\Model\CommentManager();

	    $post = $PostManager->getOnePost($_GET['id']);
	    $comments = $CommentManager->getComments($_GET['id']);

	    require('views/frontend/onePostView.php');
	}

	public function addComment($postId, $author, $comment)
	{
	    $CommentManager = new CommentManager();

	    $affectedLines = $CommentManager->postComment($postId, $author, $comment);

	    if ($affectedLines === false) {
	        throw new Exception('Impossible d\'ajouter le commentaire !');
	    }
	    else {
	        header('Location: index.php?action=post&id=' . $postId);
	    }
	}
}