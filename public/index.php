<?php
// On démarre la session directement
session_start();

// On garde certains chemin pour plus de compréhension
define('ROOT', realpath(__DIR__.'/../'));
define('APP', realpath(ROOT.'/app'));

// On récupère notre url
$url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
if (empty($url)) {
    $url = (isset($_GET['url'])) ? $_GET['url'] : '';
}

// On inclus les fonctions de base pour le MVC
require APP.'/routes/router.php';
require APP.'/controllers/controller.php';
require APP.'/models/model.php';

// On charge PHPMailer
require ROOT.'/libs/phpmailer/class.pop3.php';
require ROOT.'/libs/phpmailer/class.smtp.php';
require ROOT.'/libs/phpmailer/class.phpmailer.php';

// On y ajoute nos routes
require APP.'/routes/home.php';
require APP.'/routes/account.php';

// Sur toute les pages on veut pouvoir reconnecter la personne
// si le cookie existe mais que la session n'existe plus
if (!isset($_SESSION['auth']) && isset($_COOKIE['remember'])) {

    // On récupère nos valeurs
    $values = explode('---', $_COOKIE['remember']);

    if (count($values) === 2) {
        $id = intval($values[0]);
        $token = $values[1];

        // On charge notre model (petit soucis dans la fonction requireModel)
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
    // On require le contrôleur demandé
    $controllerPath = realpath(APP.'/controllers/'.$route['controller'].'.php');
    require $controllerPath;
} else {
    // Sinon c'est que la page demandé n'existe pas
    // On affiche une page d'erreur 404
    echo "404";
}
