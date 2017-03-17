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

$categories = getCategories($db);
$csrf = generateToken();

render('admin/forum', 'admin', compact('categories', 'csrf'));
