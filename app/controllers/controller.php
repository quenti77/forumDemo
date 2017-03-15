<?php

/**
 * Permet d'enregistrer un message flash
 *
 * @param string $type
 * @param string $content
 */
function setFlash($type, $content)
{
    $_SESSION['flash'] = compact('type', 'content');
}

/**
 * Permet d'enregistrer les erreurs et le formulaire
 *
 * @param array $errors
 * @param array $post
 */
function setErrors($errors, $post)
{
    // On enregistre notre formulaire
    $_SESSION['post'] = $post;

    $content = '<span>Des erreurs sont survenu :</span><ul>';
    foreach ($errors as $error) {
        $content .= '<li>'.$error.'</li>';
    }
    $content .= '</ul>';

    // On enregistre le contenu de l'erreur
    setFlash('danger', $content);
}

/**
 * Permet de récupérer les données et de les fusionner
 * pour les retrouver en cas d'erreur par exemple
 *
 * @param array $base
 * @return array
 */
function sessionPost($base = [])
{
    // Notre tableau qui aura les dernières données
    // et les données par défaut
    $post = [];

    // Si on trouve d'ancienne données
    if (isset($_SESSION['post'])) {
        // On les stoque
        $post = $_SESSION['post'];

        // On efface pour ne pas les reprendre
        unset($_SESSION['post']);
    }

    // Au cas ou que post ne soit pas un tableau
    if (!is_array($post)) {
        $post = [$post];
    }

    // On va fusionner les tableaux mais attention au sens
    // On fusione le tableau récupérer à celui de nos données de base
    $post = array_merge($base, $post);

    // On retourne le résultat
    return $post;
}

/**
 * Permet de récupérer ce qui se trouve en GET
 * ou en POST avec une préférence pour le GET.
 *
 * Si le GET à une clef age et le POST aussi alors
 * c'est celui du GET qui sera récupérer
 *
 * @param string $field
 * @return null|string
 */
function getParam($field)
{
    // On récupère les paramètres en GET ou en POST
    // en privilégiant ceux en GET
    if (isset($_GET[$field])) {
        return $_GET[$field];
    }

    if (isset($_POST[$field])) {
        return $_POST[$field];
    }

    // Si ça n'existe pas dans les 2
    return null;
}

/**
 * Permet de générer un token csrf que l'on mets en session
 *
 * @return string
 */
function generateToken()
{
    $token = hash('sha512', uniqid().'---'.time());

    $_SESSION['csrf'] = $token;
    return $token;
}

function render($page, $layout = null, $variables = [])
{
    // Permet de prendre un tableau et d'en créer
    // les variables correspondantes
    extract($variables);

    // Ajout d'une variable représentant l'utilisateur
    // connecté ou null s'il ne l'es pas.
    $auth = (isset($_SESSION['auth'])) ? $_SESSION['auth'] : null;

    // Rendu de notre page
    ob_start();

    // Comme pour le contrôleur mais pour les vues
    $viewPath = realpath(APP.'/views/'.$page.'.php');
    require $viewPath;

    $content = ob_get_clean();

    // La partie layout qui englobe nos page
    if ($layout != null) {
        ob_start();

        // Comme pour le contrôleur mais pour les vues
        $layoutPath = realpath(APP.'/views/layouts/'.$layout.'.php');
        require $layoutPath;

        $content = ob_get_clean();
    }

    echo $content;
}
