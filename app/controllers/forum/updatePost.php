<?php

/**
 * Formulaire pour la modification d'un post
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

// On regarde si on peut modifier le post ou pas
if ($auth['rank'] < ADMIN_RANK && $post['user_id'] !== $auth['id']) {
    // On n'a pas les droits
    setFlash('danger', 'Vous n\'êtes pas autorisé à modifier ce post');

    // Première fois que l'on met les variables directement
    redirectTo("/forums/{$forum['id']}/topics/{$topic['id']}");
}

// Si tout est bon, on génère le token et on affiche la page
$csrf = generateToken();

// Rendu de la page
render('forum/updatePost', 'front', compact('forum', 'topic', 'post', 'csrf'));
