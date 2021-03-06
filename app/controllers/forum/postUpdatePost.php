<?php

/**
 * Vérification du formulaire
 */

// On vérifie que ce dernier est connecté
if (!isset($_SESSION['auth'])) {
    // Sinon on le redirige vers la page de connexion
    setFlash('warning', 'Vous devez être connecté pour poster un message');
    redirectTo('/login');
}

// On récupère notre utilisateur connecté
$auth = $_SESSION['auth'];

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

$idPost = getParam('idPost');
$post = getPostById($db, $idPost);

// On regarde si on peut modifier le post ou pas
if ($auth['rank'] < 3 && $post['user_id'] != $auth['id']) {
    // On a pas les droits
    setFlash('danger', 'Vous n\'êtes pas autorisé à modifier ce post');
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
}

// Vérification et update si c'est bon
$csrf = getParam('csrf');
$content = getParam('content');

$errors = [];
if (empty($csrf) || empty($content)) {
    $errors[] = 'Tous les champs n\'ont pas été remplis';
}

if (empty($_SESSION['csrf']) || (empty($errors) && $csrf != $_SESSION['csrf'])) {
    $errors[] = 'Token invalide. Merci de régénérer un nouveau token';
}

if (empty($errors)) {
    $post['content'] = $content;

    // Sauvegarde
    updatePost($db, $post);

    // Message et redirection
    setFlash('success', 'Votre message à bien été modifié');
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
} else {
    setErrors($errors, []);
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}/posts/{$post['post_id']}/update");
}
