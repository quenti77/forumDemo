<?php

const ADMIN_RANK = 3;

function userMiddleware(): void
{
    if (!isset($_SESSION['auth'])) {
        setFlash('warning', 'Vous devez être connecté pour effectuer cette action');
        redirectTo('/login');
    }
}

function adminMiddleware(): void
{
    $rank = $_SESSION['auth']['rank'] ?? 0;
    if ($rank < ADMIN_RANK) {
        setFlash('danger', "Vous devez être connecté en tant qu'administrateur pour venir");
        redirectTo('/');
    }
}

/**
 * Permet d'enregistrer un message flash
 *
 * @param string $type
 * @param string $content
 * @return void
 */
function setFlash(string $type, string $content): void
{
    $_SESSION['flash'] = compact('type', 'content');
}

/**
 * Permet d'enregistrer les erreurs et le formulaire
 *
 * @param array $errors
 * @param array $post
 * @return void
 */
function setErrors(array $errors, array $post): void
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
function sessionPost(array $base = []): array
{
    // Notre tableau qui aura les dernières données
    // et les données par défaut
    $post = [];

    // Si on trouve d'anciennes données
    if (isset($_SESSION['post'])) {
        // On les gardes.
        $post = $_SESSION['post'];

        // On efface pour ne pas les reprendre
        unset($_SESSION['post']);
    }

    // Au cas où que post ne soit pas un tableau
    if (!is_array($post)) {
        $post = [$post];
    }

    // On va fusionner les tableaux, mais attention au sens
    // On fusionne le tableau récupéré à celui de nos données de base.
    // On retourne le résultat
    return array_merge($base, $post);
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
function getParam(string $field): string|null
{
    return $_GET[$field] ?? $_POST[$field] ?? null;
}

/**
 * Permet de générer un token csrf que l'on met en session
 *
 * @return string
 */
function generateToken(): string
{
    $token = hash('sha512', uniqid('', true).'---'.time());

    $_SESSION['csrf'] = $token;
    return $token;
}

function render($page, $layout = null, $variables = []): void
{
    // Permet de prendre un tableau et d'en créer
    // les variables correspondantes
    extract($variables);

    // Ajout d'une variable représentant l'utilisateur
    // connecté ou null s'il ne l'est pas.
    $auth = $_SESSION['auth'] ?? null;

    // Rendu de notre page
    ob_start();

    // Comme pour le contrôleur, mais pour les vues
    $viewPath = realpath(APP.'/views/'.$page.'.php');
    require $viewPath;

    $content = ob_get_clean();

    // La partie layout qui englobe nos pages
    if ($layout !== null) {
        ob_start();

        // Comme pour le contrôleur, mais pour les vues
        $layoutPath = realpath(APP.'/views/layouts/'.$layout.'.php');
        require $layoutPath;

        $content = ob_get_clean();
    }

    echo $content;
}
