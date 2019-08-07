<?php

namespace Blog\Model;
require_once('PDOFactory.php');

class PostManager extends PDOFactory
{
	public function getPosts()
	{
		$db = $this->getMysqlConnexion();
		$query = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i:%s\') AS creation_date_fr FROM posts ORDER BY creation_date_fr DESC LIMIT 0, 10');

		return $query;
	}

	public function getOnePost($postId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%m:%s\') AS creation_date_fr FROM posts WHERE id= ?');
		$query->execute(array($postId));
		$post = $query->fetch();

		return $post;
	}

	public function publishPost($title, $content)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
		$contentPost = $query->execute(array($title, $content));

		return $contentPost;
	}

	public function changePost($title, $content, $postId)
	{
		$db = $this->getMysqlConnexion();
		$db->exec("UPDATE posts SET title = '$title', content = '$content' WHERE id = '$postId'");
	}

	public function deletePost($postId)
	{
		$db = $this->getMysqlConnexion();
		$db->exec("DELETE FROM posts WHERE id='$postId'");
	}
}