<?php

/**
 * Permet de récupérer les topics
 * par rapport à l'id du forum
 *
 * @param PDO $db
 * @param int $idForum
 * @return PDOStatement
 */
function getTopicsByForumId(PDO $db, int $idForum): PDOStatement
{
    $reqSelect = $db->prepare(
        'SELECT T.id AS topic_id, forum_id, T.name AS topic_name, T.description, T.reply_count,
        T.resolved, T.locked,
        # User (auteur)
        U.id AS user_id, U.name AS user_name
        FROM topics AS T
        LEFT JOIN users AS U
            ON U.id = T.user_id
        WHERE forum_id = :idForum');

    $reqSelect->bindValue(':idForum', $idForum, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect;
}

/**
 * Permet de récupérer les topics via les id de forums
 *
 * @param PDO $db
 * @param int[] $forums
 * @return PDOStatement
 */
function getTopicsByForums(PDO $db, array $forums): PDOStatement
{
    $reqSelect = $db->prepare(
        'SELECT id, forum_id, user_id, name, description, reply_count, resolved,
            locked, first_post_id, last_post_id
        FROM topics
        WHERE forum_id IN ('.implode(',', $forums).')');

    $reqSelect->execute();

    return $reqSelect;
}

/**
 * Permet de récupérer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param int $idTopic
 * @return array|false
 */
function getTopicById(PDO $db, int $idTopic): false|array
{
    $reqSelect = $db->prepare(
        'SELECT id, name, description, reply_count, resolved, locked, first_post_id, last_post_id
        FROM topics
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idTopic', $idTopic, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

/**
 * Compte le nombre de topics
 *
 * @param PDO $db
 * @return int
 */
function countTopics(PDO $db): int
{
    $reqSelect = $db->prepare('SELECT COUNT(*) AS nbTopics FROM topics');
    $reqSelect->execute();

    $user = $reqSelect->fetch();
    return $user ? (int)$user['nbTopics'] : 0;
}

/**
 * Ajoute un topic
 *
 * @param PDO $db
 * @param array $topic
 * @return int
 */
function insertTopic(PDO $db, array $topic): int
{
    $reqInsert = $db->prepare(
        'INSERT INTO topics (forum_id, user_id, name, description, reply_count, resolved, locked, first_post_id, last_post_id)
        VALUES (:forumId, :userId, :name, :description, 0, 0, 0, 0, 0)');

    $reqInsert->bindValue(':forumId', $topic['forumId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':userId', $topic['userId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':name', $topic['name']);
    $reqInsert->bindValue(':description', $topic['description']);
    $reqInsert->execute();

    return (int)$db->lastInsertId();
}

/**
 * Permet de récupérer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param int $idTopic
 * @param int $idPost
 */
function updateTopicPost(PDO $db, int $idTopic, int $idPost): void
{
    $reqSelect = $db->prepare(
        'UPDATE topics
        SET last_post_id = :idPost, reply_count = `reply_count` + 1
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $reqSelect->bindValue(':idTopic', $idTopic, PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Change le last_post_id et le reply_count
 *
 * @param PDO $db
 * @param int $idTopic
 * @param int $idPost
 */
function removeTopicPost(PDO $db, int $idTopic, int $idPost): void
{
    $reqSelect = $db->prepare(
        'UPDATE topics
        SET last_post_id = :idPost, reply_count = `reply_count` - 1
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $reqSelect->bindValue(':idTopic', $idTopic, PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Suppression des topics via les forums
 *
 * @param PDO $db
 * @param int[] $forums
 */
function deleteTopicsByForums(PDO $db, array $forums): void
{
    $reqDelete = $db->prepare('DELETE FROM topics WHERE forum_id IN ('.implode(',', $forums).')');
    $reqDelete->execute();
}

/**
 * Permet de récupérer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param int $idTopic
 * @param int $idPost
 */
function updateTopicPosts(PDO $db, int $idTopic, int $idPost): void
{
    $reqSelect = $db->prepare(
        'UPDATE topics
        SET first_post_id = :idPost, last_post_id = :idPost
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $reqSelect->bindValue(':idTopic', $idTopic, PDO::PARAM_INT);
    $reqSelect->execute();
}
