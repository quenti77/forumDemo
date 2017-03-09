<?php

/**
 * Notre page d'accueil affichera les catégories et les forums
 * Mais on peut bien sur mettre cette partie sur une autre URL
 */

requireModel('categories');

$results = getCategoriesAndForums($db);
$categories = [];
$category_id = null;

foreach ($results as $result) {
    if ($category_id != $result['category_id']) {
        $category_id = $result['category_id'];
        $categories[$category_id] = [
            'name' => $result['category_name'],
            'forums' => []
        ];
    }

    $forum = [
        'id' => $result['forum_id'],
        'name' => $result['forum_name'],
        'description' => $result['description'],
        'topic_count' => $result['topic_count'],
        'post_count' => $result['post_count'],
        'post_id' => $result['post_id']
    ];

    if ($result['post_id']) {
        $forum['topic_id'] = $result['topic_id'];
        $forum['posted_at'] = DateTime::createFromFormat('Y-m-d H:i:s', $result['posted_at']);
        $forum['user_id'] = $result['user_id'];
        $forum['user_name'] = $result['user_name'];
    }

    $categories[$category_id]['forums'][] = $forum;
}

render('home/index', 'front', compact('categories'));
