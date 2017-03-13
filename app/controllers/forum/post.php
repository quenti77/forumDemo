<?php

/**
 * Affichage de la liste des posts du topic
 */

/**
 * @param $post
 * @return DateTime
 */
function postedAt($post)
{
    if ($post['updated_at']) {
        return DateTime::createFromFormat('Y-m-d H:i:s', $post['updated_at']);
    }
    return DateTime::createFromFormat('Y-m-d H:i:s', $post['posted_at']);
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
$csrf = hash('sha512', uniqid().'---'.time());

// On le stoque en session avant de le passer à la vue
$_SESSION['csrf'] = $csrf;

// Rendu de la page
render('forum/post', 'front', compact('forum', 'topic', 'posts', 'csrf'));
