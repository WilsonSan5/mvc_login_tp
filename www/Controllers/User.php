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
        $view = new View("User/login.php", "front.php");
        $view->addData('title', 'Page de connexion');

        if (isset($_POST['email']) && isset($_POST['password'])) {
            echo $_POST['email'] . ' ' . $_POST['password'];
            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($_POST['email']);
            var_dump($user);
        }
    }

    public function logout(): void
    {
        $user = new UserModel();
        $user->logout();
        //header("Location: /");
    }
}

