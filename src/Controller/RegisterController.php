<?php

namespace App\Controller;

use App\Model\UserRepository;

class RegisterController {
    public function register() {
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($this->isFormComplete()){
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $phone = $_POST['phone'];
                $postal_code = $_POST['postal_code'];
                $city = $_POST['city'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];  
            
                if ($this->isUserExists($email)){
                    $message = "L'utilisateur existe déjà";
                } elseif ($password == $confirm_password) {
                    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                    (new UserRepository())->registerUser( 
                        $lastname, 
                        $firstname, 
                        $phone, 
                        $postal_code,
                        $city,
                        $email,
                        $password_hashed
                    );
                    $message = "Inscription réussi !";
                } else {
                    $message = "Les mots de passe ne correspondent pas";
                }
            } 
        } 
        require "src/View/view/auth/register_view.php";
    }

    private function isFormComplete(){
        return isset(
            $_POST['lastname'],
            $_POST['firstname'],
            $_POST['phone'],
            $_POST['postal_code'],
            $_POST['city'],
            $_POST['email'],
            $_POST['password'],
            $_POST['confirm_password']
        );
    }


    private function isUserExists(string $email){
        $dbEmail = (new UserRepository())->searchUser($email);
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
    private function sanitize(string $input): string {
        $input = trim($input);
        $input = strip_tags($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}
}



// verifier avec une session si la personne s'est connecté pour éviter qu'il passe par l'url pour acceder au site

