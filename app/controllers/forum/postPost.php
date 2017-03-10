<?php

/**
 * Vérification de l'ajout d'une réponse au topic
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
requireModel('posts');

// On récupère les infos du forum
$idForum = getParam('idForum');
$forum = getForumById($db, $idForum);

if ($forum === false) {
    // Le forum que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', 'Le forum n\'existe pas ou plus.');
    redirectTo('/');
}

// On récupère les infos du topic
$idTopic = getParam('idTopic');
$topic = getTopicById($db, $idTopic);

if ($topic === false) {
    // Le forum que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', 'Le topic n\'existe pas ou plus.');
    redirectTo('/forums/'.$forum['id']);
}

// On récupère le contenu et le token
$content = getParam('content');
$csrf = getParam('csrf');

$errors = [];

// La partie empty
if (empty($content) || empty($csrf)) {
    $errors[] = 'Tous les champs obligatoire ne sont pas remplie';
}

// Vérification du token
$csrfSession = (isset($_SESSION['csrf'])) ? $_SESSION['csrf'] : '';
if ($csrf != $csrfSession) {
    $errors[] = 'Le formulaire à expiré';
}

// Si c'est bon
if (empty($errors)) {
    // On peut ajouter le message et
    // mettre à jours les informations des autres tables

    // Insertion du post
    $post = [
        'topicId' => $topic['id'],
        'userId' => $_SESSION['auth']['id'],
        'content' => $content
    ];
    $post['id'] = insertPost($db, $post);

    // Modification du topic et du forum (avec ajout de 1 au différent count)
    updateTopicPost($db, $topic['id'], $post['id']);
    updateForumPost($db, $forum['id'], $post['id']);

    // Message flash
    setFlash('success', 'Votre réponse a été envoyé avec succes');

} else {
    // Sinon on redirige avec une erreur
    setErrors($errors, compact('content'));
}

redirectTo('/forums/'.$forum['id'].'/topics/'.$topic['id']);
