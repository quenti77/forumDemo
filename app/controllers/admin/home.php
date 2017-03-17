<?php

/**
 * Accueil de l'administration
 */

if (!isset($_SESSION['auth']) || $_SESSION['auth']['rank'] < 3) {
    setFlash('danger', 'Vous devez être administrateur pour venir');
    redirectTo('/');
}

// On récupère nos informations
requireModel('users');
requireModel('topics');
requireModel('posts');

$count = [
    'users' => countUsers($db, true),
    'topics' => countTopics($db),
    'posts' => countPosts($db)
];

render('admin/home', 'admin', compact('count'));
