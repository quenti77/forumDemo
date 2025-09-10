<?php
// On démarre la session directement
session_start();

// On garde certains chemins pour plus de compréhension
define('ROOT', dirname(__DIR__) . '/');
define('APP', realpath(ROOT.'/app'));

// On récupère notre url
$url = $_SERVER['REQUEST_URI'] ?? $_GET['url'] ?? '';

// On inclut les fonctions de base pour le MVC
require APP.'/routes/router.php';
require APP.'/controllers/controller.php';
require APP.'/models/model.php';

/**
 * @var PDO $db
 */

// On charge PHPMailer
require ROOT.'/libs/phpmailer/class.pop3.php';
require ROOT.'/libs/phpmailer/class.smtp.php';
require ROOT.'/libs/phpmailer/class.phpmailer.php';

// On y ajoute nos routes
require APP.'/routes/home.php';
require APP.'/routes/account.php';
require APP.'/routes/forum.php';
require APP.'/routes/admin.php';

// Sur toutes les pages, on veut pouvoir reconnecter la personne
// si le cookie existe, mais que la session n'existe plus.
if (!isset($_SESSION['auth']) && isset($_COOKIE['remember'])) {

    // On récupère nos valeurs
    $values = explode('---', $_COOKIE['remember']);

    if (count($values) === 2) {
        $id = (int)$values[0];
        $token = $values[1];

        // On charge notre model (petit souci dans la fonction requireModel).
        requireModel('users');

        // On récupère l'user avec l'id
        $user = getUserById($db, $id);

        // On génère le token
        $checkToken = hash('sha512', $user['name'].'#~!*$'.$user['password']);
        if ($user && $token === $checkToken) {
            // Comme pour la connexion
            unset($user['password']);

            // Pour la session
            $_SESSION['auth'] = $user;

            // Pour le cookie que l'on réactualise
            setcookie('remember', $token, time() + 3600 * 24 * 7, '/', null, false, true);
        }
    }
}

// On lance la recherche d'une route
$route = run(method(), $url);
if ($route) {
    // Si on en trouve une
    // On inclut le contrôleur demandé
    $controllerPath = realpath(APP.'/controllers/'.$route['controller'].'.php');
    require $controllerPath;
} else {
    // Sinon c'est que la page demandée n'existe pas
    // On affiche une page d'erreur 404.
    echo "404";
}
