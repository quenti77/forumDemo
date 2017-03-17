<?php

/**
 * Ajout d'une catégorie
 */

if (!isset($_SESSION['auth']) || $_SESSION['auth']['rank'] < 3) {
    setFlash('danger', 'Vous devez être administrateur pour venir');
    redirectTo('/');
}

$csrf = getParam('csrf');
$csrfSession = isset($_SESSION['csrf']) ? $_SESSION['csrf'] : '';

if ($csrf != $csrfSession) {
    setFlash('danger', 'Token invalide. Merci de régénérer un nouveau token');
    redirectTo('/admin/forums');
}

$name = getParam('name');
if (empty($name)) {
    setFlash('danger', 'Vous n\'avez pas remplie le nom de la nouvelle catégorie');
    redirectTo('/admin/forums');
}

$order = intval(getParam('order'));

// On récupère nos informations
requireModel('categories');
insertCategory($db, $name, $order);

setFlash('success', 'Catégorie créé !');
redirectTo('/admin/forums');
