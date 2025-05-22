<?php
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
            require 'src/View/view/indexView.php';
            break;
        case 'register':
            (new RegisterController)->register();
            break;
        case 'login':
            (new LoginController)->login();
            break;
        default:
            http_response_code(404);
            echo 'Page non trouvée';
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
