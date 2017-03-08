<?php

/**
 * Formulaire d'inscription au site
 */

if (isset($_SESSION['auth'])) {
    redirectTo('/');
    exit;
}

// On doit reprendre les données en post (à faire après)
$post = sessionPost([
    'name' => '',
    'email' => ''
]);

// On rends notre page
// Première utilisation de compact
render('account/register', 'front', compact('post'));
