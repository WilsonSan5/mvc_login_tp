<?php

namespace App\Model;

use App\Core\SQL;

class User
{

	private function validateEmail(string $email): bool
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	private function validatePassword(string $password): bool
	{
		if (empty($password)) {
			return false;
		}
		if (strlen($password) < 8) {
			return false;
		}
		return true;
	}

	private function returnError($message, $messageType): array
	{
		return [
			'message' => $message,
			'messageType' => $messageType
		];
	}

    public function isLogged(): bool
    {
		if (isset($_SESSION['user'])) {
			return true;
		}
        return false;
    }

    public function logout(): void
    {
        session_destroy();
    }

    public function getUserByEmail(string $email)
    {
        $sql = new SQL();
        $queryPrepared = $sql->getOneByField('user', 'email', $email);

        return $queryPrepared;
    }

	/**
	 * The method to insert a user in the database after validation
	 * @param $data
	 * @return array
	 */
	public function insertUser($data): array
	{
		// Validate email and password
		if (!$this->validateEmail($data['email'])) {
			$message = 'Email invalide';
			$messageType = 'danger';
			return $this->returnError($message, $messageType);
		}
		if (!$this->validatePassword($data['password'])) {
			$message = 'Mot de passe invalide';
			$messageType = 'danger';
			return $this->returnError($message, $messageType);
		}
		$checkUser = $this->getUserByEmail($data['email']);
		if ($checkUser) {
			$message = 'Cet email est déjà utilisé';
			$messageType = 'danger';
			return $this->returnError($message, $messageType);
		}
		$password = password_hash($data['password'], PASSWORD_BCRYPT);
		$user = [
			'email' => $data['email'],
			'password' => $password
		];
		$sql = new SQL();
		$inserted = $sql->insertData('user', $user);

		if ($inserted) {
			$user = $this->getUserByEmail($data['email']);
			$message = 'Inscription réussie';
			$messageType = 'success';
			return [
				'message' => $message,
				'messageType' => $messageType,
				'user' => $user
			];
		} else {
			$message = 'Erreur lors de l\'inscription';
			$messageType = 'danger';
			$this->returnError($message, $messageType);
		}
	}

}
