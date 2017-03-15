<?php

/**
 * Permet de sélectionner les informations pour les
 * catégories, les forums et le dernier post du forum
 *
 * @param PDO $db
 * @return PDOStatement
 */
function getCategoriesAndForums(PDO $db)
{
    $reqSelect = $db->prepare(
        'SELECT C.id AS category_id, C.name AS category_name, C.sorted,
        # forums
        F.id AS forum_id, F.name AS forum_name, F.description, F.topic_count, F.post_count,
        # last post
        P.id AS post_id, P.posted_at, P.resolved, P.topic_id,
        # user
        U.id AS user_id, U.name AS user_name
        FROM categories AS C
        LEFT JOIN forums AS F
            ON F.category_id = C.id
        LEFT JOIN posts AS P
            ON P.id = F.last_post_id
        LEFT JOIN users AS U
            ON U.id = P.user_id
        ORDER BY C.sorted, C.id, forum_id');

    $reqSelect->execute();
    return $reqSelect;
}
