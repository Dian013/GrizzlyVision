<?php

namespace App\Controller;

use App\Model\UserRepository;

class LoginController {
    public function Login()
    {
        if (isset($_POST['username'])
        && isset($_POST['password'])) {
    
        $username_login = $_POST['username'];
        $password_login = $_POST['password'];

        try {
            $user = (new UserRepository())->searchUser($username_login);

            $email_db = $user['email'];
            $password_db = $user['password'];

            var_dump($user);
            var_dump($username_login);
            var_dump($password_login);
    
            if ($username_login == $email_db && password_verify($password_login, $password_db)) {
                session_start();
                //$_SESSION['user'] = $username;
                header('Location: /GrizzlyVision/profil');
                exit;
            } else {
                echo "Accès refusé";
                $message = "Accès refusé";
            }
        }  
        catch (\Exception $e) {
            echo 'error : '.$e->getMessage();
        }
    }
    require "src\View\html\already_has_account.php";
    }

    private function render($data = []) 
    {  
        $message = extract($data); // Extrait les variables pour les rendre accessibles dans la vue //TODO
        require $_SERVER['DOCUMENT_ROOT'] . '/CODE_PP/view/auth/login_view.php'; //$_SERVER[''] me permet de commencer le chemin par le nom du serveur où se trouvera mon projet, même si je change de serveur, tant que je garde code_pp en nom de projet
    }
}