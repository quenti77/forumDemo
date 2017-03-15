<?php

/**
 * Affichage de la liste des posts du topic
 */

/**
 * Est-ce que l'on peut edit/remove un post ?
 *
 * @param array|null $auth
 * @param array $post
 * @return bool
 */
function checkPermit($auth, $post)
{
    return ($auth['rank'] >= 3 || $post['user_id'] == $auth['id']);
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

// On charge les topics
$posts = getPostsByTopicId($db, $idTopic);

// On génère un token CSRF
$csrf = generateToken();

// Rendu de la page
render('forum/post', 'front', compact('forum', 'topic', 'posts', 'csrf'));
