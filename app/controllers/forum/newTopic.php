<?php

/**
 * Formulaire pour la création d'un nouveau topic
 */

// On vérifie que ce dernier est connecté
if (!isset($_SESSION['auth'])) {
    // Sinon on le redirige vers la page de connexion
    setFlash('warning', 'Vous devez être connecté pour poster un message');
    redirectTo('/login');
}

// On charge nos modèles
requireModel('forums');
requireModel('topics');

// On récupère les infos du forum
$idForum = getParam('idForum');
$forum = getForumById($db, $idForum);

if ($forum === false) {
    // Le forum que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', 'Le forum n\'existe pas ou plus.');
    redirectTo('/');
}

$post = sessionPost([
    'name' => '',
    'description' => '',
    'content' => ''
]);

// On génère un token CSRF
$csrf = hash('sha512', uniqid().'---'.time());

// On le stoque en session avant de le passer à la vue
$_SESSION['csrf'] = $csrf;

// Rendu de la page
render('forum/newTopic', 'front', compact('forum', 'post', 'csrf'));
