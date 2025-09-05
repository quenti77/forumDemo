<?php

/**
 * Ajout d'un forum
 *
 * @var PDO $db
 */

adminMiddleware();

requireModel('forums');

$idForum = getParam('idForum');
$forum = getForumById($db, $idForum);

if ($forum === false) {
    setFlash('danger', 'Forum invalide');
    redirectTo('/admin/forums');
}

$csrf = getParam('csrf');
$csrfSession = $_SESSION['csrf'] ?? '';

if ($csrf !== $csrfSession) {
    setFlash('danger', 'Token invalide. Merci de régénérer un nouveau token');
    redirectTo('/admin/forums');
}

$idCategory = getParam('category');
$description = getParam('description');

$name = getParam('name');
if (empty($idCategory) || empty($name)) {
    setFlash('danger', "Vous n'avez pas remplie tous les champs");
    redirectTo('/admin/forums');
}

// On récupère nos informations
updateForum($db, $idForum, $idCategory, $name, $description);

setFlash('success', 'Forum créé !');
redirectTo('/admin/forums');
