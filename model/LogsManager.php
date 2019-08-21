<?php

namespace Blog\Model;
require_once('PDOFactory.php');

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