<?php
namespace App\Controllers;

use App\Model\User as UserModel;
use App\Core\View;

class User
{
    public function register(): void
    {
        $view = new View("User/register.php", "front.php");
        $view->addData('title', 'Page d\'inscription Test');
		$view->addData('description', 'Inscrivez-vous pour accéder à toutes les fonctionnalités de notre site');

		if (isset($_POST['email']) && isset($_POST['password'])) {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			extract($_POST);
			$data = [
				'email' => strtolower(trim($email)),
				'password' => trim($password)
			];
			$userModel = new UserModel();
			$user = $userModel->insertUser($data);
			extract($user);
			unset($userData['password']);
			$data = [
				'message' => $message,
				'messageType' => $messageType,
			];
			if ($user['messageType'] !== 'success') {
				$_SESSION['user'] = $userData;
//				$view->addData('result', $message);
				header("Location: /");
			}
		}

    }

    public function login(): void
    {
        $alert = '';
        $view = new View("User/login.php", "front.php");
        $view->addData('title', 'Page de connexion');

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($_POST['email']);
<<<<<<< HEAD
            if (!$user || $user['password'] != $_POST['password']) {
                $alert = 'Email ou mot de passe invalide.';
            } else {
                $alert = 'Connecté !';
            }
=======
>>>>>>> mohed
        }
        $view->addData('alert', $alert);
    }

    public function logout(): void
    {
        $user = new UserModel();
        $user->logout();
        header("Location: /");
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> mohed
