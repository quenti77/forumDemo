<?php

/**
 * Ajout d'une catégorie
 */

if (!isset($_SESSION['auth']) || $_SESSION['auth']['rank'] < 3) {
    setFlash('danger', 'Vous devez être administrateur pour venir');
    redirectTo('/');
}

requireModel('categories');
requireModel('forums');
requireModel('topics');
requireModel('posts');

$idCategory = getParam('idCategory');
$category = getCategory($db, $idCategory);

if ($category === false) {
    setFlash('danger', 'Catégorie invalide');
    redirectTo('/admin/forums');
}

$csrf = getParam('csrf');
$csrfSession = isset($_SESSION['csrf']) ? $_SESSION['csrf'] : '';

if ($csrf != $csrfSession) {
    setFlash('danger', 'Token invalide. Merci de régénérer un nouveau token');
    redirectTo('/admin/forums');
}

// Récupération de tous les ids des forums lié au catégories
$result = getForumsByCategory($db, $idCategory);
$forums = [];

foreach ($result as $forum) {
    $forums[] = intval($forum['id']);
}

// Récupération de tous les ids des topics lié aux forums
$result = getTopicsByForums($db, $forums);
$topics = [];

foreach ($result as $topic) {
    $topics[] = intval($topic['id']);
}

// Suppression des posts lié au topics
if (!empty($topics)) {
    deletePostsByTopics($db, $topics);
}

// Suppression des topics lié au forums
if (!empty($forums)) {
    deleteTopicsByForums($db, $forums);
}

// Suppression des forums
deleteForums($db, $idCategory);

// Enfin suppression de la catégorie
deleteCategory($db, $idCategory);

setFlash('success', 'Catégorie supprimé !');
redirectTo('/admin/forums');
