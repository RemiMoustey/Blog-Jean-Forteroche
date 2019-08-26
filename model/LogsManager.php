<?php

namespace Blog\Model;
require_once('PDOFactory.php');

/**
  * Récupère dans la base de données les informations de connexion (login et mot de passe hashé)
  * à entrer pour se connecter à l'interface administrateur.
  *
  * @author  Rémi Moustey <remimoustey@gmail.com>
  */
class LogsManager extends PDOFactory
{
  /**
   * Sélectionne les identifiants de l'administrateur du blog
   *
   * @return array
   */
  public function getLogs()
	{
		$db = $this->getMysqlConnexion();
		$query = $db->query('SELECT * FROM logs');
		$logs = $query->fetch();

		return $logs;
  }
}