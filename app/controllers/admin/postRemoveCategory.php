<?php

/**
 * Ajout d'une catégorie
 *
 * @var PDO $db
 */

adminMiddleware();

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
$csrfSession = $_SESSION['csrf'] ?? '';

if ($csrf !== $csrfSession) {
    setFlash('danger', 'Token invalide. Merci de régénérer un nouveau token');
    redirectTo('/admin/forums');
}

// Récupération de tous les ids des forums liés aux catégories
$result = getForumsByCategory($db, $idCategory);
$forums = [];

foreach ($result as $forum) {
    $forums[] = (int)$forum['id'];
}

if (!empty($forums)) {
    // Récupération de tous les ids des topics liés aux forums
    $result = getTopicsByForums($db, $forums);
    $topics = [];

    foreach ($result as $topic) {
        $topics[] = (int)$topic['id'];
    }

    if (!empty($topics)) {
        // Suppression des posts liés au topics
        deletePostsByTopics($db, $topics);

        // Suppression des topics lié aux forums
        deleteTopicsByForums($db, $forums);
    }

    // Suppression des forums
    deleteForums($db, $idCategory);
}

// Enfin suppression de la catégorie
deleteCategory($db, $idCategory);

setFlash('success', 'Catégorie supprimé !');
redirectTo('/admin/forums');
