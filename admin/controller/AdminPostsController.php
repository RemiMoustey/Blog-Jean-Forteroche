<?php

namespace Blog\Admin\Controller;
use \Blog\Model;

require_once('../model/PostManager.php');
require_once('../model/CommentManager.php');

class AdminPostsController
{
    public function listPosts()
	{
		$PostManager = new \Blog\Model\PostManager();
		$posts = $PostManager->getPosts();

		require('views/frontend/adminListPostsView.php');
	}

	public function onePost()
	{
	    $PostManager = new \Blog\Model\PostManager();
	    $CommentManager = new \Blog\Model\CommentManager();

	    $post = $PostManager->getOnePost($_GET['id']);
	    $comments = $CommentManager->getComments($_GET['id']);

	    require('views/frontend/adminOnePostView.php');
	}

	public function addComment($postId, $author, $comment)
	{
	    $CommentManager = new \Blog\Model\CommentManager();

	    $affectedLines = $CommentManager->postComment($postId, $author, $comment);

	    if ($affectedLines === false)
	    {
	        throw new Exception('Impossible d\'ajouter le commentaire.');
	    }
	    else 
	    {
	        header('Location: adminIndex.php?action=post&id=' . $postId);
	    }
    }
    
    public function addPost($title, $content)
	{
		$PostManager = new \Blog\Model\PostManager();

		$contentPost = $PostManager->publishPost($title, $content);

		if ($contentPost === false)
		{
			throw new Exception("Impossible d'ajouter le billet.");
		}
		else
		{
			header('Location: admin/adminIndex.php');
		}
    }

    public function modifyPost()
    {
        $PostManager = new \Blog\Model\PostManager();

        $post = $PostManager->getOnePost($_GET['id']);

        require('tinymce.php');
    }

    public function updatePost($title, $content)
    {
        $PostManager = new \Blog\Model\PostManager();
		$contentPost = $PostManager->changePost($title, $content);

		if ($contentPost === false)
		{
			throw new Exception("Impossible de modifier le billet.");
		}
		else
		{
			header('Location: adminIndex.php');
		}
    }

    public function removePost($postId)
    {
        $PostManager = new \Blog\Model\PostManager();
        $post = $PostManager->deletePost($postId);
        
        if ($post === false)
        {
            throw new Exception("Impossible de supprimer le billet.");
        }
        else
        {
            header('Location: adminIndex.php');
        }
    }
}