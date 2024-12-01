<?php
namespace App\Controllers;

use App\Model\User as UserModel;
use App\Core\View;

class User
{
    public function register(): void
    {
        $view = new View("User/register.php", "front.php");
        $view->addData('title', 'Page d\'inscription');
    }

    public function login(): void
    {
        $alert = '';
        $view = new View("User/login.php", "front.php"); // Appeler la bonne vue
        $view->addData('title', 'Page de connexion');

        if (isset($_POST['email']) && isset($_POST['password'])) { // Vérifier si les champs sont remplie
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($_POST['email']);
            if (!$user || $user['password'] != $_POST['password']) {
                $alert = 'Email ou mot de passe invalide.';
            } else {
                $alert = 'Connecté !';
            }
        } else {
            $alert = 'Veuillez remplir les champs !';
        }
        $view->addData('alert', $alert);
    }

    public function logout(): void
    {
        $user = new UserModel();
        $user->logout();
        header("Location: /");
    }
}