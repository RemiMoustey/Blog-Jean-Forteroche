<?php

namespace Blog\Model;
define('PER_PAGE', 5);
require_once('PDOFactory.php');

/**
  * Récupère les informations brutes sur les chapitres dans la base de données et les organise
  * selon différentes nécessités afin qu'elles puissent être traitées par le
  * contrôleur.
  *
  * @author  Rémi Moustey <remimoustey@gmail.com>
  */
class PostManager extends PDOFactory
{
	/**
	 * Sélectionne tous les chapitres du blog dans la base de données
	 *
	 * @return PDOStatement
	 */
	public function getPosts()
	{
		$db = $this->getMysqlConnexion();
		$page = (int)($_GET['p'] ?? 1);
		$offset = ($page - 1) * PER_PAGE;
		if ($offset < 0)
		{
			$offset = 0;
		}

		return $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%i\') AS creation_date_fr FROM posts ORDER BY creation_date_fr DESC LIMIT ' . PER_PAGE . " OFFSET $offset");
	}

	/**
	 * Compte le nombre de chapitres dans la base de données
	 *
	 * @return PDOStatement
	 */
	public function countPosts()
	{
		$db = $this->getMysqlConnexion();
		return $db->query("SELECT count(id) as count FROM posts");
	}

	/**
	 * Sélectionne un chapitre sélectionné par l'utilisateur dans la base de données
	 *
	 * @param  string $postId
	 *
	 * @return array
	 */
	public function getOnePost($postId)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %H:%m\') AS creation_date_fr FROM posts WHERE id= ?');
		$query->execute(array($postId));
		$post = $query->fetch();

		return $post;
	}

	/**
	 * Insère un chapitre écrit par l'administrateur dans la base de données
	 *
	 * @param  string $title
	 * @param  string $content
	 *
	 * @return bool
	 */
	public function publishPost($title, $content)
	{
		$db = $this->getMysqlConnexion();
		$query = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
		$contentPost = $query->execute(array($title, $content));

		return $contentPost;
	}

	/**
	 * Met à jour un chapitre modifié par l'administrateur dans la base de données
	 *
	 * @param  string $title
	 * @param  string $content
	 * @param  string $postId
	 *
	 * @return void
	 */
	public function changePost($title, $content, $postId)
	{
		$db = $this->getMysqlConnexion();
		$adaptatedContent = str_replace("\"", "\\\"", $content); 
		$db->exec("UPDATE posts SET title = \"$title\", content = \"$adaptatedContent\" WHERE id = \"$postId\"");
		// Les guillemets doubles sont échappés pour que les éventuels attributs "style" des balises <p> ne produisent pas d'erreur de syntaxe.
	}

	/**
	 * Retire un chapitre supprimé par l'administrateur de la base de données
	 *
	 * @param  string $postId
	 *
	 * @return void
	 */
	public function deletePost($postId)
	{
		$db = $this->getMysqlConnexion();
		$db->exec("DELETE comments FROM comments
		INNER JOIN posts ON comments.post_id = posts.id
		WHERE comments.post_id = $postId");
		$db->exec("DELETE FROM posts WHERE id='$postId'");
	}
}