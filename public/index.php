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

// On y ajoute nos routes
require APP.'/routes/home.php';

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
