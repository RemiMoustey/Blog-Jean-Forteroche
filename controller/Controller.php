<?php

namespace Blog\Controller;
use \Blog\Model;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LogsManager.php');

class Controller
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
		
		if($post === false)
		{
			echo '<p>Impossible d\'afficher le billet.</p>';
			return;
		}

		$comments = $CommentManager->getComments($_GET['id']);
		$notifiedComments = $CommentManager->getNotifiedComments($_GET['id']);

	    require('views/frontend/onePostView.php');
	}

	public function addComment($postId, $author, $comment)
	{
	    $CommentManager = new \Blog\Model\CommentManager();

	    $affectedLines = $CommentManager->postComment($postId, $author, $comment);

	    if ($affectedLines === false)
	    {
			echo '<p>Impossible d\'afficher le commentaire.</p>';
			return;
	    }
		
		header('Location: index.php?action=post&id=' . $postId . "#anchor-comments");
    }

	public function reportComment($commentId)
	{
		$CommentManager = new \Blog\Model\CommentManager;
		$comment = $CommentManager->notifyComment($commentId);
		$notifiedComment = $CommentManager->addNotifiedComment($commentId, $comment['post_id'], $comment['author'], $comment['comment']);

		if ($comment === false)
		{
			echo '<p>Impossible de signaler le commentaire.</p>';
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