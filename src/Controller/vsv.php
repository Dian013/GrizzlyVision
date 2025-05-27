<?php

function login()
{
    $errors = ['username' => '', 'password' => ''];
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        $errors = $this->validateLoginForm($data);

        if (empty(array_filter($errors))) {
            $repo = new UserRepository();
            $user = $repo->searchUser($data['username']);

            if ($user && password_verify($data['password'], $user['password'])) {
                $_SESSION['user'] = $user['email'];
                header('Location: /GrizzlyVision/profil');
                exit;
            } else {
                $message = "Accès refusé.";
            }
        }
    }

    require "src/View/html/already_has_account.php";
}


function validateLoginForm(array $data): array
{
    $errors = [];

    if (empty($data['username'])) {
        $errors[] = "Le champ utilisateur est requis.";
    }

    if (empty($data['password'])) {
        $errors[] = "Le mot de passe est requis.";
    }

    return $errors;
}

function logout()
{
    session_destroy();
    header('Location: index.php?page=login');
}
