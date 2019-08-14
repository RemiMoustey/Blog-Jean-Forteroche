<?php

namespace Blog\Model;
require_once('PDOFactory.php');

class CommentManager extends PDOFactory
{
	public function getComments($postId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT id, author, comment, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS creation_date_fr FROM comments WHERE post_id = ? ORDER BY creation_date DESC');
		$query->execute(array($postId));

		return $query;
	}

	public function postComment($postId, $author, $comment)
    {
        $db = $this->getMysqlConnexion();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, creation_date) VALUES(?, ?, ?, NOW())');
		$affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
	}
	
	public function notifyComment($commentId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT post_id, author, comment, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%m\') AS creation_date_fr FROM comments WHERE id= ?');
		$query->execute(array($commentId));
		$comment = $query->fetch();

		return $comment;
	}

	public function addNotifiedComment($commentId, $post_Id, $author, $comment)
	{
		$db = $this->getMysqlConnexion();

		$notifiedComment = $db->prepare('INSERT INTO notifiedComments(comment_id, post_id, author, comment, notify_date) VALUES(?, ?, ?, ?, NOW())');
		$affectedLine = $notifiedComment->execute(array($commentId, $post_Id, $author, $comment));

		return $affectedLine;
	}

	public function getNotifiedComments($postId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT comment_id, post_id, author, comment, DATE_FORMAT(notify_date, \'%d/%m/%Y à %H:%i\') AS notify_date_fr FROM notifiedComments WHERE post_id = ? ORDER BY notify_date DESC');
		$query->execute(array($postId));

		return $query;
	}

	public function deleteComment($commentId)
	{
		$db = $this->getMysqlConnexion();
		$db->exec("DELETE FROM comments WHERE id=$commentId");
	}
}