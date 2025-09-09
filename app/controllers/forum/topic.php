<?php

/**
 * Affichage de la liste des topics du forum
 *
 * @var PDO $db
 */

/**
 * On déclare une fonction pour la vue
 *
 * @param array $topic
 * @return string
 */
function getStatus(array $topic): string
{
    if ($topic['locked']) { return '<i class="text-danger fa fa-lock fa-2x"></i>'; }
    if ($topic['resolved']) { return '<i class="text-success fa fa-check fa-2x"></i>'; }
    return '';
}

// On charge nos modèles
requireModel('forums');
requireModel('topics');

// On récupère les infos du forum
$idForum = getParam('idForum');
$forum = getForumById($db, $idForum);

if ($forum === false) {
    // Le forum que l'on demande n'existe pas
    // On redirige avec un message flash
    setFlash('danger', "Le forum n'existe pas ou plus.");
    redirectTo('/');
}

// On charge les topics
$topics = getTopicsByForumId($db, $idForum);

// Rendu de la page
render('forum/topic', 'front', compact('forum', 'topics'));
