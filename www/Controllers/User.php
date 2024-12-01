<?php
namespace App\Controllers;

use App\Model\User as U;
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
    }

    public function logout(): void
    {
        $user = new U;
        $user->logout();
        //header("Location: /");
    }
}

