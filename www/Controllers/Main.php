<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\AuthMiddleware;

class Main
{

    public function home(): void
    {
		// Login required
		AuthMiddleware::requireLogin();
        $pseudo = $_SESSION['user']->email ?? '';
        $view = new View("Main/home.php");
        $view->addData("pseudo", $pseudo);
    }

}
