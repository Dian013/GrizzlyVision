<?php

namespace App\Controller;

use App\Model\UserRepository;

class LoginController
{
    public function login()
    {
        $errors = [
            'username' => '', 
            'password' => ''
        ];
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_SERVER['REQUEST_METHOD'];

            $form_data = $_POST;
            $errors = $this->validateLoginForm($form_data);

            if ($errors == ['username' => '', 'password' => '']) {

                $user = (new UserRepository())->searchUser($form_data['username']);

                $email_db = $user['username'];
                $password_db = $user['password'];


                if ($form_data['username'] == $email_db && password_verify($form_data['password'], $password_db)) {
                    $_SESSION['user'] = $form_data['username'];
                    header('Location: /GrizzlyVision/profil');
                    exit;
                } else {
                    $message = "Identifiants incorrects.";
                }
            } 
        } else {
            $title = $_SERVER['REQUEST_METHOD'];
        }
        require "src/View/html/already_has_account.php";
    }

    private function validateLoginForm($data)
    {
        $errors = [];

        $username = trim($data['username'] ?? '');
        $password = $data['password'] ?? '';

        if (empty($username)) {
            $errors['username'] = "Le nom d'utilisateur est requis.";
        } else {
            $errors['username'] = "";
        }

        if (empty($password)) { //||  strlen($password) < 6) {
            $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères.";
        } else {
            $errors['password'] = "";
        }

        return $errors;
    }


    public function logout()
    {
        session_destroy();
        header('Location: index.php?page=login');
    }
}