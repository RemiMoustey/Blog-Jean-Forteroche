<?php

namespace Blog\Model;

/**
  * Permet une connexion à la base de données en vue de récupérer les informations.
  * Toutes les classes du modèle en héritent.
  *
  * @author  Rémi Moustey <remimoustey@gmail.com>
  */
abstract class PDOFactory
{
	/**
	 * Permet la connexion à la base de données concernant toutes les données du blog
	 *
	 * @return PDO
	 */
	public static function getMysqlConnexion()
	{
		$db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}