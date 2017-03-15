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

/**
 * Permet de récupérer un post via son id
 *
 * @param PDO $db
 * @param $idPost
 * @return array|false
 */
function getPostById(PDO $db, $idPost)
{
    $reqSelect = $db->prepare(
        'SELECT P.id AS post_id, P.content, P.posted_at, P.updated_at, P.resolved,
        # User (auteur)
        U.id AS user_id, U.name AS user_name
        FROM posts AS P
        LEFT JOIN users AS U
            ON U.id = P.user_id
        WHERE P.id = :idPost');

    $reqSelect->bindValue(':idPost', intval($idPost), PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

function findLastPostTopic(PDO $db, $idTopic)
{
    $reqSelect = $db->prepare(
        'SELECT id, topic_id, user_id, content, posted_at, updated_at, resolved
        FROM posts
        WHERE topic_id = :idTopic
        ORDER BY id DESC
        LIMIT 0, 1');
    $reqSelect->bindValue(':idTopic', $idTopic, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

/**
 * Ajoute un post
 *
 * @param PDO $db
 * @param array $post
 * @return int
 */
function insertPost(PDO $db, $post)
{
    $reqInsert = $db->prepare(
        'INSERT INTO posts (topic_id, user_id, content, posted_at, updated_at, resolved) 
        VALUES (:topicId, :userId, :content, NOW(), NULL, 0)');

    $reqInsert->bindValue(':topicId', $post['topicId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':userId', $post['userId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':content', $post['content'], PDO::PARAM_STR);
    $reqInsert->execute();

    return intval($db->lastInsertId());
}

/**
 * Mets à jour le contenu du post
 *
 * @param PDO $db
 * @param array $post
 */
function updatePost(PDO $db, $post)
{
    $reqUpdate = $db->prepare(
        'UPDATE posts
        SET content = :content, updated_at = NOW()
        WHERE id = :postId');

    $reqUpdate->bindValue(':content', $post['content'], PDO::PARAM_STR);
    $reqUpdate->bindValue(':postId', $post['post_id'], PDO::PARAM_INT);
    $reqUpdate->execute();
}

/**
 * Suppression d'un post
 *
 * @param PDO $db
 * @param int $postId
 */
function removePost(PDO $db, $postId)
{
    $reqDelete = $db->prepare('DELETE FROM posts WHERE id = :postId');
    $reqDelete->bindValue(':postId', $postId, PDO::PARAM_INT);
    $reqDelete->execute();
}

/**
 * @param $post
 * @return DateTime
 */
function postedAt($post)
{
    if ($post['updated_at']) {
        return DateTime::createFromFormat('Y-m-d H:i:s', $post['updated_at']);
    }
    return DateTime::createFromFormat('Y-m-d H:i:s', $post['posted_at']);
}
