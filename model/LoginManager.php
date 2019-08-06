<?php

namespace Blog\Model;

class LoginManager extends PDOFactory
{
    public function getLogs()
    {
        $db = $this->getMysqlConnexion();
		$query = $db->query('SELECT user_login, user_password FROM logs');

		return $query;
    }
}