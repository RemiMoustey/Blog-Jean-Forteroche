<?php

namespace Blog\Model;

require_once('PDOFactory.php');

class CommentManager extends PDOFactory
{
	/**
	 * Sélectionne tous les commentaires d'un chapitre dans la base de données
	 *
	 * @param  string $postId
	 *
	 * @return PDOStatement
	 */
	public function getComments($postId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT id, author, comment, post_id, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS creation_date_fr FROM comments WHERE post_id = ? ORDER BY creation_date DESC');
		$query->execute(array($postId));

		return $query;
	}

	/**
	 * Insère un commentaire se rapportant à un chapitre dans la base de données
	 *
	 * @param  string $postId
	 * @param  string $author
	 * @param  string $comment
	 *
	 * @return bool
	 */
	public function postComment($postId, $author, $comment)
    {
        $db = $this->getMysqlConnexion();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, creation_date) VALUES(?, ?, ?, NOW())');
		$affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
	}
	
	/**
	 * Sélectionne dans la base de données un commentaire signalé par un utilisateur
	 *
	 * @param  string $commentId
	 *
	 * @return array (les champs du commentaire corespondent aux index)
	 */
	public function notifyComment($commentId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT post_id, author, comment, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%m\') AS creation_date_fr FROM comments WHERE id= ?');
		$query->execute(array($commentId));
		$comment = $query->fetch();

		return $comment;
	}

	/**
	 * Insert un commentaire signalé dans la base de données
	 *
	 * @param  string $commentId
	 * @param  string $post_Id
	 * @param  string $author
	 * @param  string $comment
	 *
	 * @return bool
	 */
	public function addNotifiedComment($commentId, $post_Id, $author, $comment)
	{
		$db = $this->getMysqlConnexion();

		$notifiedComment = $db->prepare('INSERT INTO notifiedComments(comment_id, post_id, author, comment, notify_date) VALUES(?, ?, ?, ?, NOW())');
		$affectedLine = $notifiedComment->execute(array($commentId, $post_Id, $author, $comment));

		return $affectedLine;
	}

	/**
	 * Sélectionne les commentaires signalés se rapportant à un chapitre dans la base de données 
	 *
	 * @param  string $postId
	 *
	 * @return PDOStatement
	 */
	public function getNotifiedComments($postId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT comment_id, post_id, author, comment, DATE_FORMAT(notify_date, \'%d/%m/%Y à %H:%i\') AS notify_date_fr FROM notifiedComments WHERE post_id = ? ORDER BY notify_date DESC');
		$query->execute(array($postId));

		return $query;
	}

	/**
	 * Supprime de la base de données un commentaire (dans les tables comments et notifiedcomments)
	 *
	 * @param  string $commentId
	 * @param  string $postId
	 *
	 * @return PDOStatement
	 */
	public function deleteComment($commentId, $postId)
	{
		$db = $this->getMysqlConnexion();
		$db->exec("DELETE FROM comments WHERE id=$commentId");
		$query = $db->prepare('SELECT post_id FROM comments WHERE post_id = :post_id');
		$query->execute(['post_id' => $postId]);

		return $query;
	}
}