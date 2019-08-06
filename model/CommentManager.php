<?php

namespace Blog\Model;
require_once('PDOFactory.php');

class CommentManager extends PDOFactory
{
	public function getComments($postId) {
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT id, author, comment, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comments WHERE post_id = ? ORDER BY creation_date DESC');
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
}