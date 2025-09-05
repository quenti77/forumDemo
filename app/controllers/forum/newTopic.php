<?php

/**
 * Formulaire pour la création d'un nouveau topic
 *
 * @var PDO $db
 */

userMiddleware();

// On charge nos modèles
requireModel('forums');
requireModel('topics');

// On récupère les infos du forum
$idForum = getParam('idForum');
$forum = getForumById($db, $idForum);

if ($forum === false) {
    // Le forum que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', "Le forum n'existe pas ou plus.");
    redirectTo('/');
}

$post = sessionPost([
    'name' => '',
    'description' => '',
    'content' => ''
]);

// On génère un token CSRF
$csrf = generateToken();

// Rendu de la page
render('forum/newTopic', 'front', compact('forum', 'post', 'csrf'));
