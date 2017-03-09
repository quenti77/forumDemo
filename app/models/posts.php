<?php

/**
 * Permet de récupèrer les posts
 * par rapport à l'id du topic
 *
 * @param PDO $db
 * @param $idTopic
 * @return PDOStatement
 */
function getPostsByTopicId(PDO $db, $idTopic)
{
    $reqSelect = $db->prepare(
        'SELECT P.id AS post_id, P.content, P.posted_at, P.updated_at, P.resolved,
        # User (auteur)
        U.id AS user_id, U.name AS user_name
        FROM posts AS P
        LEFT JOIN users AS U
            ON U.id = P.user_id
        WHERE P.topic_id = :idTopic');

    $reqSelect->bindValue(':idTopic', intval($idTopic), PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect;
}
