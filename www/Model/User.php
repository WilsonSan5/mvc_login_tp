<?php

namespace App\Model;

use App\Core\SQL;

class User
{

	/**
	 * The method to validate email
	 * @param string $email
	 * @return bool
	 */
	private function validateEmail(string $email): bool
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	/**
	 * The method to validate password
	 * @param string $password
	 * @return bool
	 */
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

	/**
	 * The method to return an error message
	 * @param string $message
	 * @param string $messageType
	 * @return array
	 */
	private function returnError(string $message, string $messageType): array
	{
		return [
			'message' => $message,
			'messageType' => $messageType
		];
	}

	/**
	 * The method to check if a user is logged
	 * @return bool
	 */
	public function isLogged(): bool
	{
		if (isset($_SESSION['user'])) {
			return true;
		}
		return false;
	}

	/**
	 * The method to log a user in
	 * @return void
	 */
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
	 * @param array $data
	 * @return array
	 */
	public function insertUser(array $data): array
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
	/**
	 * The method to validate email
	 * @param string $email
	 * @param string $password
	 * 
	 */
	public function checkPassword($email, $password)
	{
		$user = $this->getUserByEmail($email);
		if ($user && password_verify($password, $user->password)) {
			return [
				'message' => 'Connexion réussie',
				'messageType' => 'success',
				'user' => $user
			];
		} else {
			return [
				'message' => 'Email ou mot de passe incorrect',
				'messageType' => 'danger'
			];
		}
	}
}

