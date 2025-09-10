<?php

/**
 * Suppression du post
 *
 * @var PDO $db
 */

// On vérifie que ce dernier est connecté
if (!isset($_SESSION['auth'])) {
    // Sinon, on le redirige vers la page de connexion
    setFlash('warning', 'Vous devez être connecté pour supprimer un message');
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

// On regarde si on peut modifier le post ou pas
if ($auth['rank'] < ADMIN_RANK && $post['user_id'] !== $auth['id']) {
    // On n'a pas les droits
    setFlash('danger', 'Vous n\'êtes pas autorisé à supprimer ce post');
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
}

$csrf = getParam('csrf');
if (empty($_SESSION['csrf']) || $csrf !== $_SESSION['csrf']) {
    setFlash('danger', 'Token invalide. Merci de régénérer un nouveau token');
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
}

// Vérification si c'est le premier post du topic
if ($topic['first_post_id'] === $post['post_id']) {
    setFlash('warning', "Vous ne pouvez pas supprimer ce post car c'est le premier du topic");
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
}

// Suppression du post
$newLastPost = $post;
removePost($db, $post['post_id']);

// Changement du lastPostId si celui-ci est remove
if ($post['post_id'] === $topic['last_post_id']) {
    $newLastPost = findLastPostTopic($db, $topic['id']);
}

removeTopicPost($db, $topic['id'], $newLastPost['id']);
removeForumPost($db, $forum['id'], $newLastPost['id']);

updateTopicResolution($db, $topic['id']);

setFlash('success', 'Votre message a bien été supprimé');
redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
