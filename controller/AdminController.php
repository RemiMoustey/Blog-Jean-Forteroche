<?php

namespace Blog\Controller;
use \Blog\Model;

require_once('../model/PostManager.php');
require_once('../model/CommentManager.php');

class AdminController
{
    public function listPosts()
	{
		$PostManager = new \Blog\Model\PostManager();
		$posts = $PostManager->getPosts();

		require('../admin/views/frontend/adminListPostsView.php');
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

	    require('../admin/views/frontend/adminOnePostView.php');
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
		
		header('Location: adminChapters.php?action=post&id=' . $postId);
    }
    
    public function addPost($title, $content)
	{
		$PostManager = new \Blog\Model\PostManager();

		$contentPost = $PostManager->publishPost($title, $content);

		if ($contentPost === false)
		{
			echo '<p>Impossible de signaler le commentaire.</p>';
			return;
		}

		header('Location: adminChapters.php');
    }

    public function modifyPost()
    {
        $PostManager = new \Blog\Model\PostManager();

        $post = $PostManager->getOnePost($_GET['id']);

        require('../admin/tinymce.php');
    }

    public function updatePost($title, $content, $postId)
    {
        $PostManager = new \Blog\Model\PostManager();
		$contentPost = $PostManager->changePost($title, $content, $postId);

		if ($contentPost === false)
		{
			throw new Exception("Impossible de modifier le billet.");
			return;
		}

		header('Location: adminChapters.php');
    }

    public function removePost($postId)
    {
        $PostManager = new \Blog\Model\PostManager();
        $post = $PostManager->deletePost($postId);
        
        if ($post === false)
        {
			throw new Exception("Impossible de supprimer le billet.");
			return;
        }
		
		header('Location: adminChapters.php');
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

		header('Location: adminChapters.php?action=post&id=' . $comment['post_id']);
	}

	public function removeComment($commentId, $postId)
	{
		$CommentManager = new \Blog\Model\CommentManager;
		$comment = $CommentManager->deleteComment($commentId, $postId);

		if ($comment === false)
		{
			throw new Exception("Impossible de supprimer le commentaire.");
			return;
		}
		
		header('Location: adminChapters.php?action=post&id=' . $postId);
	}
}