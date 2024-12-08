<?php

namespace App\Controllers;

use App\Model\User as UserModel;
use App\Core\View;
use App\Core\Messages;
use App\Core\AuthMiddleware;

class User
{
	/**
	 * The method to register a user and redirect to the home page after successful registration
	 * @return void
	 */
	public function register(): void
	{
		// Check if the user is already logged in
		if (AuthMiddleware::isLogged()) {
			header("Location: /");
			exit;
		}
		// Load the view
		$view = new View("User/register.php", "front.php");
		$view->addData('title', 'Page d\'inscription');
		$view->addData('description', 'Inscrivez-vous pour accéder à toutes les fonctionnalités de notre site');
		$data = [];
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Sanitize $_POST super global
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			// Check the data values from the form and clean them
			$data = $this->dataCheckerAndCleaner($_POST);
			if (!$data) {
				return;
			}

			// Check if the password and confirm password match
			if ($_POST['password'] !== $_POST['confirm_password']) {
				Messages::setMessage('Les mots de passe ne correspondent pas', 'error');
				return;
			}
			$userModel = new UserModel();
			$result = $userModel->insertUser($data);
			if ($result['messageType'] === 'danger' || $result['messageType'] === 'error') {
				// Set message in a session on Error.
				Messages::setMessage($result['message'], $result['messageType']);
			} else {
				// On success, redirect to the home page with a success message.
				Messages::setMessage($result['message'], 'success');
				// Unset password from the user object before storing it in the session.
				unset($result['user']->password);
				$_SESSION['user'] = $result['user'];
				header("Location: /");
				exit;
			}
		}
	}

	public function login(): void
	{
		$view = new View("User/login.php", "front.php"); // Appeler la bonne vue
		$view->addData('title', '');

		// Vérifier que la methode est POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Vérifier que les champs sont remplies

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = $this->dataCheckerAndCleaner($_POST);
			if (!$data) {
				return;
			}

			$userModel = new UserModel();
			$result = $userModel->checkPassword($data['email'], $data['password']); // Vérifier que le password est
			// correct
			if ($result['messageType'] === 'danger') {
				Messages::setMessage($result['message'], 'error');
				return;
			}
			// Si toutes les vérifications sont OK
			$_SESSION['user'] = $result['user'];
			header("Location: /");
			exit;
		}
	}

	public function logout(): void
	{
		AuthMiddleware::requireLogin();
		$user = new UserModel();
		$user->logout();
		header("Location: /login");
	}


	private function dataCheckerAndCleaner(array $data): array|bool
	{
		foreach ($data as $key => $value) {
			if ($key === 'submit') {
				continue;
			}
			if (empty($value)) {
				Messages::setMessage("Veuillez remplir le champ $key", 'error');
				return false;
			}
			if ($key === 'email') {
				$data[$key] = strtolower(trim($value));
			}
			$data[$key] = trim($value);
		}
		return $data;
	}
}
