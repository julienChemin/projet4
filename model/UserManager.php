<?php

namespace Chemin\Blog\Model;

use Chemin\Blog\Model\Database;

class UserManager extends Database
{
	public function getUser(string $pseudo)
	{
		if (strlen($pseudo) > 0) {
			return $this->sql('
				SELECT pseudo, password 
				FROM user
				WHERE pseudo = :pseudo',
				[':pseudo' => $pseudo]);
		}
	}

	public function exists(string $pseudo)
	{
		if (strlen($pseudo) > 0) {
			$req = $this->sql('
				SELECT pseudo
				FROM user
				WHERE pseudo = :pseudo',
				[':pseudo' => $pseudo]);

			if ($req->fetch()) {
				return true;
			}
		} else {
			return false;
		}
	}

	public function checkPassword(string $pseudo, string $password)
	{
		if (strlen($pseudo) > 0 && strlen($password) > 0) {
			$user = $this->getUser($pseudo)->fetch();

			return password_verify($password, $user['password']);
		}
	}
}
