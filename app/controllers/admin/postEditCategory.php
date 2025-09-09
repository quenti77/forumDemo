<?php

/**
 * Ajout d'une catégorie
 *
 * @var PDO $db
 */

adminMiddleware();

requireModel('categories');

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

$name = getParam('name');
if (empty($name)) {
    setFlash('danger', "Vous n'avez pas remplie le nom de la nouvelle catégorie");
    redirectTo('/admin/forums');
}

$order = (int)getParam('order');

updateCategory($db, $idCategory, $name, $order);

setFlash('success', 'Catégorie mise à jour !');
redirectTo('/admin/forums');
