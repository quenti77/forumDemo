<?php

/**
 * Gestion des catégories/forums
 */

if (!isset($_SESSION['auth']) || $_SESSION['auth']['rank'] < 3) {
    setFlash('danger', 'Vous devez être administrateur pour venir');
    redirectTo('/');
}

// On récupère nos informations
requireModel('categories');
requireModel('forums');

$result = getCategories($db);
$categories = [];

foreach ($result as $category) {
    $categories[] = $category;
}

$forums = getForums($db);
$csrf = generateToken();

render('admin/forum', 'admin', compact('categories', 'forums', 'csrf'));
