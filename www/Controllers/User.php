<?php

namespace App\Controllers;

use App\Model\User as UserModel;
use App\Core\View;
use App\Core\Messages;

class User
{
	public function register(): void
	{
		$userModel = new UserModel();
		if ($userModel->isLogged()) {
			Messages::setMessage('Vous êtes déjà connecté', 'error');
			header("Location: /");
			exit;
		}

		$view = new View("User/register.php", "front.php");
		$view->addData('title', 'Page d\'inscription Test');
		$view->addData('description', 'Inscrivez-vous pour accéder à toutes les fonctionnalités de notre site');
		$data = [];
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Early return if necessary data is missing
			if (!isset($_POST['email']) || !isset($_POST['password'])) {
				$data['message'] = 'Veuillez remplir tous les champs';
				$view->addData('data', $data);
				return;
			}
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$formData = [
				'email' => strtolower(trim($_POST['email'])),
				'password' => trim($_POST['password'])
			];

			$result = $userModel->insertUser($formData);
			if ($result['messageType'] === 'danger' || $result['messageType'] === 'error') {
				Messages::setMessage($result['message'], 'error');
			} else {
				Messages::setMessage($result['message'], 'success');
				unset($result['user']->password);
				$_SESSION['user'] = $result['user'];
				header("Location: /");
				exit;
			}
		}
	}

	public function login(): void
	{
		$view = new View("User/login.php", "front.php");
		$view->addData('title', 'Page de connexion');

		if (isset($_POST['email']) && isset($_POST['password'])) {
			echo $_POST['email'] . ' ' . $_POST['password'];
			$userModel = new UserModel();
			$user = $userModel->getUserByEmail($_POST['email']);
		}
	}

	public function logout(): void
	{
		$user = new UserModel();
		$user->logout();
		header("Location: /");
	}
}
