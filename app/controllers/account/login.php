<?php

/**
 * Formulaire de connexion au site
 */

if (isset($_SESSION['auth'])) {
    redirectTo('/');
    exit;
}

// On doit reprendre les données en post (à faire après)
$post = sessionPost([
    'name' => ''
]);

// On rends notre page
render('account/login', 'front', compact('post'));
