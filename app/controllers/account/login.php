<?php

/**
 * Formulaire de connexion au site
 */

if (isset($_SESSION['auth'])) {
    redirectTo('/');
}

// On doit reprendre les données en post (à faire après).
$post = sessionPost([
    'name' => ''
]);

// On rend notre page
render('account/login', 'front', compact('post'));
