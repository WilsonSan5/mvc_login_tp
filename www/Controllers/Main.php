<?php

namespace App\Controllers;

use App\Core\View;

class Main
{

    public function home(): void
    {
        $pseudo = $_SESSION['user']->email ?? '';
        $view = new View("Main/home.php");
        $view->addData("pseudo", $pseudo);
    }

}