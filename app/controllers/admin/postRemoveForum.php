<?php

/**
 * Suppression d'un forum
 */

if (!isset($_SESSION['auth']) || $_SESSION['auth']['rank'] < 3) {
    setFlash('danger', 'Vous devez être administrateur pour venir');
    redirectTo('/');
}

requireModel('forums');
requireModel('topics');
requireModel('posts');

$idForum = getParam('idForum');
$forum = getForumById($db, $idForum);

if ($forum === false) {
    setFlash('danger', 'Forum invalide');
    redirectTo('/admin/forums');
}

$csrf = getParam('csrf');
$csrfSession = isset($_SESSION['csrf']) ? $_SESSION['csrf'] : '';

if ($csrf != $csrfSession) {
    setFlash('danger', 'Token invalide. Merci de régénérer un nouveau token');
    redirectTo('/admin/forums');
}

// Récupération de tous les ids des topics lié aux forums
$result = getTopicsByForums($db, [$idForum]);
$topics = [];

foreach ($result as $topic) {
    $topics[] = intval($topic['id']);
}

// Suppression des posts lié au topics
if (!empty($topics)) {
    deletePostsByTopics($db, $topics);
}

// Suppression des topics lié au forums
deleteTopicsByForums($db, [$idForum]);

// Suppression du forum
deleteForum($db, $idForum);

setFlash('success', 'Forum supprimé !');
redirectTo('/admin/forums');
