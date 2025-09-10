<?php

/**
 * Formulaire d'inscription au site
 */

if (isset($_SESSION['auth'])) {
    redirectTo('/');
}

// On doit reprendre les données en post (à faire après).
$post = sessionPost([
    'name' => '',
    'email' => ''
]);

// On rend notre page
// Première utilisation de compact
render('account/register', 'front', compact('post'));
