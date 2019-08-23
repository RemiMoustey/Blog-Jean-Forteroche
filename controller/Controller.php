<?php

namespace Blog\Controller;
use \Blog\Model;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LogsManager.php');

/**
  * Récupère les données demandées au modèle et renvoie les éléments à afficher à la
  * vue côté utilisateur standard.
  *
  * @author  Rémi Moustey <remimoustey@gmail.com>
  */
class Controller
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

		require('views/frontend/listPostsView.php');
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

	    require('views/frontend/onePostView.php');
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
		
		header('Location: chapters.php?action=post&id=' . $postId . "#anchor-comments");
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
			echo '<p>Impossible de signaler le commentaire.</p>';
			return;
		}

		header('Location: chapters.php?action=post&id=' . $comment['post_id']);
	}

	/**
	 * Récupère le login et le mot de passe hashé de la base de données en vue de l'authentification
	 *
	 * @return void
	 */
	public function login()
	{
		$logsManager = new \Blog\Model\LogsManager;
		$logs = $logsManager->getLogs();

		require('views/frontend/loginView.php');
	}
}