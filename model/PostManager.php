<?php

namespace Blog\Model;
require_once('Database.php');

class PostManager extends Database
{
	public function getPosts()
	{
		$db = $this->dbConnect();
		$query = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%i/%Y à %Hh %mmin %ssec\') AS creation_date_fr FROM posts ORDER BY creation_date_fr DESC LIMIT 0, 10');

		return $query;
	}

	public function getOnePost($postId)
	{
		$db = $this->dbConnect();
		$query = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%i/%Y à %Hh %mmin %ssec\') AS creation_date_fr FROM posts WHERE id= ?');
		$query->execute(array($postId));
		$post = $query->fetch();

		return $post;
	}
}