<?php

namespace App\Model;

use App\Core\SQL;

class User
{

    public function isLogged(): bool
    {
        return false;
    }

    public function logout(): void
    {
        session_destroy();
    }

    // public function login(): void
    // {// Check if user is logged in if so redirect to the home page
    //     if (isset($_SESSION['user'])) {
    //         header("Location: /");
    //     }// Load the view$view = new View("User/login.php", "front.php");// Add the title to the view$view->addData('title', 'Connexion');

    //     // Check if the form is submitted
    //     if (isset($_POST['submit'])) {
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //         extract($_POST);
    //         $data = [
    //             'email' => strtolower(trim($email)),
    //             'password' => trim($password)
    //         ];
    //         // SQL request
    //         $sql = new SQL();

    //         // Check if the user exists
    //         $result = $sql->getUser("user", $data);

    //         // If the user exists, store the user in the session and redirect to the home page
    //         if ($result['user']) {
    //             $_SESSION['user'] = $result['user'];
    //             header("Location: /");
    //         } else {
    //             $view->addData('result', $result);
    //         }
    //     }
    // }

    public function getUserByEmail(string $email)
    {
        $sql = new SQL();
        $queryPrepared = $sql->getOneByField('user', 'email', $email);

        return $queryPrepared;
    }

	public function insertUser($data)
	{
		$sql = new SQL();
		$checkUser = $sql->getOneByField('user', 'email', $data['email']);
		if ($checkUser) {
			$message = 'Cet email est déjà utilisé';
			$messageType = 'danger';
		} else {
			$user = $sql->insertData('user', $data);
			$message = 'Utilisateur enregistré';
			$messageType = 'success';
		}
		// GEt the user data after registration
		$user = $sql->getOneByField('user', 'email', $data['email']);

		return [
			'message' => $message,
			'messageType' => $messageType,
			'userData' => $user ?? null
		];
	}

}
