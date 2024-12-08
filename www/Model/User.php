<?php

namespace App\Model;

use App\Core\SQL;

class User extends SQL
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

	/**
	 * The method to get a user by email
	 * @param string $email
	 * @return mixed
	 */
	public function getUserByEmail(string $email): mixed
	{
		return $this->getOneByField('user', 'email', $email);
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
		// Check if the password is valid
		if (!$this->validatePassword($data['password'])) {
			$message = 'Mot de passe invalide';
			$messageType = 'danger';
			return $this->returnError($message, $messageType);
		}
		// Check if the email is already used
		$checkUser = $this->getUserByEmail($data['email']);
		if ($checkUser) {
			$message = 'Cet email est déjà utilisé';
			$messageType = 'danger';
			return $this->returnError($message, $messageType);
		}

		// Hash the password
		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		// Insert the user in the database
		$inserted = $this->insertData('user', $data);

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
	 * @return array
	 */
	public function checkPassword(string $email, string $password): array
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

	/**
	 * The method to update a user
	 * @param array $data
	 * @param int $id
	 * @return array
	 */
	public function updateUser(array $data, int $id): array
	{
		// Validate email and password
		if (!$this->validateEmail($data['email'])) {
			$message = 'Email invalide';
			$messageType = 'danger';
			return $this->returnError($message, $messageType);
		}
		// Check if the email is already used
		$checkUser = $this->getUserByEmail($data['email']);
		if ($checkUser && $checkUser->id !== $id) {
			$message = 'Cet email est déjà utilisé';
			$messageType = 'danger';
			return $this->returnError($message, $messageType);
		}
		// Update the user in the database
		$updated = $this->updateData('user', $data, $id);
		if ($updated) {
			$user = $this->getOneById('user', $id);
			$message = 'Profil modifié';
			$messageType = 'success';
			return [
				'message' => $message,
				'messageType' => $messageType,
				'user' => $user
			];
		} else {
			$message = 'Erreur lors de la modification';
			$messageType = 'danger';
			$this->returnError($message, $messageType);
		}
	}


}
