<?php

namespace App\Controller;

use App\Model\UserRepository;

class RegisterController
{
    public function register()
    {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->isFormComplete()) {
                $username = $_POST['username'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                (new UserRepository())->registerUser(
                    $username,
                    $phone,
                    $email,
                    $password_hashed
                );
                $_SESSION['user'] = $username;
                header('Location: redirect_page');
            }
            $message = "Formulaire incomplet";
        }
        require "src\View\html\sign_up.php";
    }

    private function isFormComplete()
    {
        return isset(
            $_POST['username'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['password']
        );
    }


    private function isUserExists(string $email)
    {
        $user = (new UserRepository())->searchUser($email);
        $dbEmail = $user['email'];
        return $dbEmail === $email;
    }


    /**
     * Sanitize a string input for safe output in HTML context.
     *
     * This function trims whitespace, removes HTML and PHP tags,
     * and converts special characters to HTML entities to prevent XSS attacks.
     *
     * @param string $input The input string to sanitize.
     * @return string The sanitized string safe for HTML output.
     * @access public
     */
    private function sanitize(string $input): string
    {
        $input = trim($input);
        $input = strip_tags($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }
}



// verifier avec une session si la personne s'est connecté pour éviter qu'il passe par l'url pour acceder au site

