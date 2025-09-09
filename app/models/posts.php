<?php

/**
 * Permet de récupérer les posts
 * par rapport à l'id du topic
 *
 * @param PDO $db
 * @param int $idTopic
 * @return PDOStatement
 */
function getPostsByTopicId(PDO $db, int $idTopic): PDOStatement
{
    $reqSelect = $db->prepare(
        'SELECT P.id AS post_id, P.content, P.posted_at, P.updated_at, P.resolved,
        # User (auteur)
        U.id AS user_id, U.name AS user_name
        FROM posts AS P
        LEFT JOIN users AS U
            ON U.id = P.user_id
        WHERE P.topic_id = :idTopic');

    $reqSelect->bindValue(':idTopic', $idTopic, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect;
}

/**
 * Permet de récupérer un post via son id
 *
 * @param PDO $db
 * @param int $idPost
 * @return array|false
 */
function getPostById(PDO $db, int $idPost): false|array
{
    $reqSelect = $db->prepare(
        'SELECT P.id AS post_id, P.content, P.posted_at, P.updated_at, P.resolved,
        # User (auteur)
        U.id AS user_id, U.name AS user_name
        FROM posts AS P
        LEFT JOIN users AS U
            ON U.id = P.user_id
        WHERE P.id = :idPost');

    $reqSelect->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

function findLastPostTopic(PDO $db, int $idTopic): false|array
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
 * Compte le nombre de posts
 *
 * @param PDO $db
 * @return int
 */
function countPosts(PDO $db): int
{
    $reqSelect = $db->prepare('SELECT COUNT(*) AS nbPosts FROM posts');
    $reqSelect->execute();

    $user = $reqSelect->fetch();
    return $user ? (int)$user['nbPosts'] : 0;
}

/**
 * Ajoute un post
 *
 * @param PDO $db
 * @param array $post
 * @return int
 */
function insertPost(PDO $db, array $post): int
{
    $reqInsert = $db->prepare(
        'INSERT INTO posts (topic_id, user_id, content, posted_at, updated_at, resolved) 
        VALUES (:topicId, :userId, :content, NOW(), NULL, 0)');

    $reqInsert->bindValue(':topicId', $post['topicId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':userId', $post['userId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':content', $post['content']);
    $reqInsert->execute();

    return (int)$db->lastInsertId();
}

/**
 * Mets à jour le contenu du post
 *
 * @param PDO $db
 * @param array $post
 * @return void
 */
function updatePost(PDO $db, array $post): void
{
    $reqUpdate = $db->prepare(
        'UPDATE posts
        SET content = :content, updated_at = NOW(), resolved = :resolved
        WHERE id = :postId');

    $reqUpdate->bindValue(':content', $post['content']);
    $reqUpdate->bindValue(':resolved', $post['resolved'], PDO::PARAM_INT);
    $reqUpdate->bindValue(':postId', $post['post_id'], PDO::PARAM_INT);
    $reqUpdate->execute();
}

/**
 * Suppression d'un post
 *
 * @param PDO $db
 * @param int $postId
 * @return void
 */
function removePost(PDO $db, int $postId): void
{
    $reqDelete = $db->prepare('DELETE FROM posts WHERE id = :postId');
    $reqDelete->bindValue(':postId', $postId, PDO::PARAM_INT);
    $reqDelete->execute();
}

/**
 * Suppression des posts via les topics
 *
 * @param PDO $db
 * @param int[] $topics
 * @return void
 */
function deletePostsByTopics(PDO $db, array $topics): void
{
    $reqDelete = $db->prepare('DELETE FROM posts WHERE topic_id IN ('.implode(',', $topics).')');
    $reqDelete->execute();
}

/**
 * @param array $post
 * @return DateTime
 */
function postedAt(array $post): DateTime
{
    if ($post['updated_at']) {
        return DateTime::createFromFormat('Y-m-d H:i:s', $post['updated_at']);
    }
    return DateTime::createFromFormat('Y-m-d H:i:s', $post['posted_at']);
}
