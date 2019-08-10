<?php

namespace Blog\Controller;
use \Blog\Model;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LogsManager.php');

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
	    $CommentManager = new \Blog\Model\CommentManager();

	    $affectedLines = $CommentManager->postComment($postId, $author, $comment);

	    if ($affectedLines === false)
	    {
			throw new Exception('Impossible d\'ajouter le commentaire.');
			return;
	    }
		
		header('Location: index.php?action=post&id=' . $postId);
    }

	public function reportComment($commentId)
	{
		$CommentManager = new \Blog\Model\CommentManager;
		$comment = $CommentManager->notifyComment($commentId);
		$notifiedComment = $CommentManager->addNotifiedComment($commentId, $comment['post_id'], $comment['author'], $comment['comment']);

		if ($comment === false)
		{
			throw new Exception("Impossible de signaler le commentaire.");
			return;
		}

		header('Location: index.php?action=post&id=' . $comment['post_id']);
	}

	public function login()
	{
		$logsManager = new \Blog\Model\LogsManager;
		$logs = $logsManager->getLogs();

		require('views/frontend/loginView.php');
	}
}