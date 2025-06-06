<?php
session_start(); 

define('ROOT', dirname(__DIR__) . '/');
define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'));


require_once 'vendor/autoload.php';

use App\Controller\LoginController;
use App\Controller\RegisterController;

try {
    // Récupère l'URI sans query string (ex: /register)
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $route = trim(str_replace(BASE_URL, '', $uri), '/');

    switch ($route) {
        case '' :
        case 'welcome':
            require 'src/View/indexView.php';
            break;
        case 'profil':
            require 'src/View/html/profil.php';
            break;
        case 'sign_up':
            (new RegisterController)->register();
            break;
        case 'already_has_account':
            (new LoginController)->login();
            break;        
        case 'redirect_page':
            if (isset($_SESSION['user'])) {
                require 'src\View\html\redirect_page.php';
                break;
            } else {
                echo "erreur";
            }
        default:
            http_response_code(404);
            echo 'Page non trouvée';
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
