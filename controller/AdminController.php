<?php

namespace Blog\Controller;
use \Blog\Model;

require_once('../model/PostManager.php');
require_once('../model/CommentManager.php');

/**
  * Récupère les données demandées au modèle et renvoie les éléments à afficher à la
  * vue côté administrateur.
  *
  * @author  Rémi Moustey <remimoustey@gmail.com>
  */
class AdminController
{
    /**
     * Récupère les chapitres et le nombre de chapitres pour la pagination
     *
     * @return void (cette méthode est utile pour les vues)
     */
    public function listPosts()
	{
		$PostManager = new \Blog\Model\PostManager();
		$posts = $PostManager->getPosts();
		$countPosts = $PostManager->countPosts();

		require('../admin/views/frontend/adminListPostsView.php');
	}

	/**
	 * Récupère un post sélectionné au préalable
	 *
	 * @return void (cette méthode est utile pour les vues)
	 */
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

	/**
	 * Envoie les données du commentaire ajouté à la base de données
	 *
	 * @param  string $postId
	 * @param  string $author
	 * @param  string $comment
	 *
	 * @return void (cette méthode est utile pour la vue)
	 */
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
    
    /**
     * Envoie les données du chapitre ajouté à  la base de données
     *
     * @param  string $title
     * @param  string $content
     *
     * @return void (cette méthode est utile pour la vue)
     */
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

    /**
     * Récupère les données du chapitre original afin de les modifier
     *
     * @return void (cette méthode est utile pour la vue)
     */
    public function modifyPost()
    {
        $PostManager = new \Blog\Model\PostManager();

        $post = $PostManager->getOnePost($_GET['id']);

        require('../admin/tinymce.php');
    }

    /**
     * Envoie les données du chapitre mis à jour dans la base de données
     *
     * @param  string $title
     * @param  string $content
     * @param  string $postId
     *
     * @return void (cette méthode est utile pour les vues)
     */
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

    /**
     * Envoie les données d'un chapitre qui doit être supprimé de la base de données
     *
     * @param  string $postId
     *
     * @return void (cette méthode est utile pour les vues)
     */
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
	
	/**
	 * Envoie l'identifiant du commentaire signalé afin qu'il soit ajouter à la table notifiedcomments
	 *
	 * @param  string $commentId
	 *
	 * @return void (cette méthode est utile pour les vues)
	 */
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

	/**
	 * Envoie les données du commentaire qui doit être supprimé de la base de données
	 *
	 * @param  string $commentId
	 * @param  string $postId
	 *
	 * @return void (cette méthode est utile pour les vues)
	 */
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