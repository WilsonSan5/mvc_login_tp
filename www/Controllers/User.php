<?php
namespace App\Controllers;

use App\Model\User as UserModel;
use App\Core\View;
use App\Core\Messages;

class User
{
    /**
     * The method to register a user and redirect to the home page after successful registration
     * @return void
     */
    public function register(): void
    {
        $userModel = new UserModel();
        // if ($userModel->isLogged()) {
        //     Messages::setMessage('Vous êtes déjà connecté', 'error');
        //     header("Location: /");
        //     exit;
        // }
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
            // Sanitize $_POST super global
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $formData = [
                'email' => strtolower(trim($_POST['email'])),
                'password' => trim($_POST['password'])
            ];

            $result = $userModel->insertUser($formData);
            if ($result['messageType'] === 'danger' || $result['messageType'] === 'error') {
                // Set message in a session on Error.
                Messages::setMessage($result['message'], 'error');
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
        $alert = ''; // Définir une valeur par défaut pour $alert
        $view = new View("User/login.php", "front.php"); // Appeler la bonne vue
        $view->addData('title', 'Page de connexion');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifier si la méthode est POST
            if (isset($_POST['email']) && isset($_POST['password'])) { // Vérifier si les champs sont remplis
                $userModel = new UserModel();
                $user = $userModel->getUserByEmail($_POST['email']); // Supposons que $user soit un objet

                if (!$user) {
                    $alert = 'Email ou mot de passe invalide.';
                } else {
                    // Utiliser password_verify pour comparer
                    if (password_verify($_POST['password'], $user->password)) {
                        $alert = 'Connecté !';
                        $_SESSION['user'] = $user;
                        header("Location: /");
                        exit;
                    } else {
                        $alert = 'Email ou mot de passe invalide.';
                    }
                }
            } else {
                $alert = 'Veuillez remplir les champs !';
            }
        }

        // Ajouter $alert aux données de la vue (fait une seule fois)
        $view->addData('alert', $alert);
    }


    public function logout(): void
    {
        $user = new UserModel();
        $user->logout();
        header("Location: /");
    }
}
