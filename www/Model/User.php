<?php

namespace App\Model;
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


}