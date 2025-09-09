<?php

// On sauvegarde nos urls et on ça pointe dans ce tableau
$routes = []; // PS: Nouvelle syntaxe des tableaux

// Les redirections possibles
$redirections = [
    '301' => 'Moved Permanently',
    '302' => 'Moved Temporarily',
    '303' => 'See Other'
];

/**
 * Permet de trim une url mais de
 * garder au minimum le root en /
 *
 * @param string $url
 * @return string
 */
function trimUrl($url)
{
    // On enlève les / de début et de fin
    // On passe de "/news/1//" à "news/1"
    $url = trim($url, '/');

    // Mais si on a par exemple "/" alors ça deviens du vide
    // Et on veut garder au minimum le "/"
    if (empty($url)) {
        return '/';
    }

    // Si c'est pas vide on retourne ce que l'on a trim
    return $url;
}

/**
 * Redirige vers l'URL demandé avec les bons headers
 *
 * @param string $url
 * @param int $code
 * @return never
 */
function redirectTo($url, $code = 301): never
{
    // On récupère nos code de redirections possible
    global $redirections;

    if (!in_array($code, $redirections)) {
        $code = 301;
    }

    header("HTTP/1.1 {$code} {$redirections[$code]}", false, $code);
    header("location: {$url}");
    exit;
}

/**
 * Ajoute une nouvelle url à notre application
 * Le tableau routes est un tableau de tableau contenant des cases
 * qui sont des tableaux.
 *
 * @param string $method
 * @param string $url
 * @param string $controller
 */
function addRoute($method, $url, $controller)
{
    // On a besoin de nos routes
    global $routes;

    // Ajout de la route
    $url = trimUrl($url);
    $routes[$method][] = [
        'url' => $url,
        'controller' => $controller
    ];
}

/**
 * Permet de retourner la méthode utilisé par HTTP
 * pour venir sur la page. GET, POST, PUT, PATCH, DELETE, ...
 *
 * @return string
 */
function method()
{
    if (isset($_SERVER['REQUEST_METHOD'])) {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    return 'get';
}

/**
 * Regarde si l'url demandé match l'url en cible
 *
 * @param string $urlCheck
 * @param string $urlTarget
 * @return bool
 */
function urlMatch($urlCheck, $urlTarget)
{
    // On transforme les : puis un nom en une regex qui va pouvoir
    // trouver les variables qui sont dans l'url
    $subRegex = preg_replace('#:([\w]+)#', '([^/]+)', $urlTarget);

    // On l'inclu dans une regex
    $regexTarget = "#^{$subRegex}$#i"; // Explication du {$var}

    // On regarde si notre url que l'on check match ou pas
    // avec la regex de notre url cible
    if (!preg_match($regexTarget, $urlCheck, $matchValue)) {
        // ça na pas match donc on return directement false
        // car c'est pas la bonne url
        return false;
    }

    // Si preg_match à fonctionner alors $matchValue contient les valeur
    // des variables de l'url. Ex: /news/2 => le 2 est dans le tableau

    // On enlève le premier résultat qui nous intéresse pas
    array_shift($matchValue);

    // On prends les noms des variables que l'on va associé aux valeurs
    // et que l'on va mettre dans le tableau $_GET
    preg_match($regexTarget, $urlTarget, $matchName);
    array_shift($matchName); // Pareil que pour matchValue

    foreach ($matchName as $index => $name) {
        // on enlève le :
        $name = str_replace(':', '', $name);

        // $matcheValue[0] correspond à la variable dans $matchName[0]
        $_GET[$name] = $matchValue[$index];
    }

    // On a trouver notre url donc on retourne true
    return true;
}

/**
 * On regarde nos routes pour voir si ça match nos URL
 * et on retourne le tableau de l'URL qui a match ou false sinon.
 *
 * @param string $method
 * @param string $url
 * @return array|false
 */
function run(string $method, string $url): array|false
{
    // On récupère nos routes
    global $routes;

    // On trim l'URL demandé
    $url = trimUrl($url);

    // Si la méthode utilisée (GET, POST, ...) n'a aucune route
    // ça ne sert à rien de continuer.
    if (!isset($routes[$method])) {
        return false;
    }

    // On boucle nos routes qui sont dans la méthode demandé
    foreach ($routes[$method] as $route) {
        // On regarde si ça match
        if (urlMatch($url, $route['url'])) {
            // Si c'est bon on retourne notre route
            return $route;
        }
    }

    // Sinon c'est que l'on a pas trouver de route qui match
    return false;
}
