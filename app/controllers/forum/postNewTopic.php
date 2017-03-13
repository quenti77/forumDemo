<?php

// On vérifie que ce dernier est connecté
if (!isset($_SESSION['auth'])) {
    // Sinon on le redirige vers la page de connexion
    setFlash('warning', 'Vous devez être connecté pour poster un message');
    redirectTo('/login');
}

// On charge nos modèles
requireModel('forums');
requireModel('topics');
requireModel('posts');

// On récupère les infos du forum
$idForum = getParam('idForum');
$forum = getForumById($db, $idForum);

if ($forum === false) {
    // Le forum que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', 'Le forum n\'existe pas ou plus.');
    redirectTo('/');
}

// On récupère nos champs
$name = getParam('name');
$description = getParam('description');
$content = getParam('content');

// Nos erreurs
$errors = [];

if (empty($name) || empty($content)) {
    $errors[] = 'Certains champs n\'ont pas été rempli';
}

if (empty($errors)) {
    // Insertion du nouveau topic
    $topic = [
        'forumId' => $forum['id'],
        'userId' => $_SESSION['auth']['id'],
        'name' => $name,
        'description' => $description
    ];
    $topic['id'] = insertTopic($db, $topic);

    // Insertion du nouveau post
    $post = [
        'topicId' => $topic['id'],
        'userId' => $_SESSION['auth']['id'],
        'content' => $content
    ];
    $post['id'] = insertPost($db, $post);

    // Modification du topic et du forum (avec ajout de 1 au différent count)
    updateTopicPosts($db, $topic['id'], $post['id']);
    updateForumTopic($db, $forum['id'], $post['id']);

    setFlash('success', 'Création de votre topic avec succès');
    redirectTo('/forums/'.$forum['id'].'/topics/'.$topic['id']);
} else {
    setErrors($errors, compact('name', 'description', 'content'));
    redirectTo('/forums/'.$forum['id'].'/newTopic');
}
