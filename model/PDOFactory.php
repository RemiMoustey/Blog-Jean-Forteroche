<?php

namespace Blog\Model;

// Toutes les autres classes du modèle héritent de cette classe
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