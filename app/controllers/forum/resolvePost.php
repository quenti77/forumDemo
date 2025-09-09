<?php

/**
 * Vérification du formulaire
 *
 * @var PDO $db
 */

userMiddleware();

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
    setFlash('danger', "Le forum n'existe pas ou plus.");
    redirectTo('/');
}

// On récupère les infos du topic
$idTopic = getParam('idTopic');
$topic = getTopicById($db, $idTopic);

if ($topic === false) {
    // Le topic que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', "Le topic n'existe pas ou plus.");
    redirectTo('/forums/'.$forum['id']);
}

$idPost = getParam('idPost');
$post = getPostById($db, $idPost);
if ($post === false) {
    // Le post que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', "Le post n'existe pas ou plus.");
    redirectTo('/forums/'.$forum['id'].'/topics/'.$topic['id']);
}

// On regarde si on peut modifier le post ou pas
if ($auth['rank'] < ADMIN_RANK && $topic['user_id'] !== $auth['id']) {
    // On n'a pas les droits
    setFlash('danger', "Vous n'êtes pas autorisé à modifier ce post");
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
}

// Vérification et update si c'est bon
$csrf = getParam('csrf');

$errors = [];
if (empty($csrf)) {
    $errors[] = "Tous les champs n'ont pas été remplis";
}

if (empty($_SESSION['csrf']) || (empty($errors) && $csrf !== $_SESSION['csrf'])) {
    $errors[] = 'Token invalide. Merci de régénérer un nouveau token';
}

if (empty($errors)) {
    $post['resolved'] = $post['resolved'] === 1 ? 0 : 1;

    updatePost($db, $post);
    updateTopicResolution($db, $topic['id']);

    // Message et redirection
    setFlash('success', 'Votre message a bien été modifié');
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
} else {
    setErrors($errors, []);
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}/posts/{$post['post_id']}/update");
}
