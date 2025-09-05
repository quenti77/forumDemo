<?php

/**
 * Ajout d'une catégorie
 *
 * @var PDO $db
 */

adminMiddleware();

$csrf = getParam('csrf');
$csrfSession = $_SESSION['csrf'] ?? '';

if ($csrf !== $csrfSession) {
    setFlash('danger', 'Token invalide. Merci de régénérer un nouveau token');
    redirectTo('/admin/forums');
}

$name = getParam('name');
if (empty($name)) {
    setFlash('danger', "Vous n'avez pas remplie le nom de la nouvelle catégorie");
    redirectTo('/admin/forums');
}

$order = (int)getParam('order');
if ($order < -2_000_000 || $order > 2_000_000) {
    $order = 0;
}

// On récupère nos informations
requireModel('categories');
insertCategory($db, $name, $order);

setFlash('success', 'Catégorie créé !');
redirectTo('/admin/forums');
