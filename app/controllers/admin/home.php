<?php

/**
 * Accueil de l'administration
 *
 * @var PDO $db
 */

adminMiddleware();

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
