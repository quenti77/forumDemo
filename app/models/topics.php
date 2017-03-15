<?php

/**
 * Permet de récupèrer les topics
 * par rapport à l'id du forum
 *
 * @param PDO $db
 * @param $idForum
 * @return PDOStatement
 */
function getTopicsByForumId(PDO $db, $idForum)
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

    $reqSelect->bindValue(':idForum', intval($idForum), PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect;
}

/**
 * Permet de récupèrer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param $idTopic
 * @return array|false
 */
function getTopicById(PDO $db, $idTopic)
{
    $reqSelect = $db->prepare(
        'SELECT id, name, description, reply_count, resolved, locked, first_post_id, last_post_id
        FROM topics
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idTopic', intval($idTopic), PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

/**
 * Ajoute un topic
 *
 * @param PDO $db
 * @param array $topic
 * @return int
 */
function insertTopic(PDO $db, $topic)
{
    $reqInsert = $db->prepare(
        'INSERT INTO topics (forum_id, user_id, name, description, reply_count, resolved, locked, first_post_id, last_post_id)
        VALUES (:forumId, :userId, :name, :description, 0, 0, 0, 0, 0)');

    $reqInsert->bindValue(':forumId', $topic['forumId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':userId', $topic['userId'], PDO::PARAM_INT);
    $reqInsert->bindValue(':name', $topic['name'], PDO::PARAM_STR);
    $reqInsert->bindValue(':description', $topic['description'], PDO::PARAM_STR);
    $reqInsert->execute();

    return intval($db->lastInsertId());
}

/**
 * Permet de récupèrer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param $idTopic
 * @param $idPost
 */
function updateTopicPost(PDO $db, $idTopic, $idPost)
{
    $reqSelect = $db->prepare(
        'UPDATE topics
        SET last_post_id = :idPost, reply_count = `reply_count` + 1
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idPost', intval($idPost), PDO::PARAM_INT);
    $reqSelect->bindValue(':idTopic', intval($idTopic), PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Change le last_post_id et le reply_count
 *
 * @param PDO $db
 * @param $idTopic
 * @param $idPost
 */
function removeTopicPost(PDO $db, $idTopic, $idPost)
{
    $reqSelect = $db->prepare(
        'UPDATE topics
        SET last_post_id = :idPost, reply_count = `reply_count` - 1
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idPost', intval($idPost), PDO::PARAM_INT);
    $reqSelect->bindValue(':idTopic', intval($idTopic), PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Permet de récupèrer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param $idTopic
 * @param $idPost
 */
function updateTopicPosts(PDO $db, $idTopic, $idPost)
{
    $reqSelect = $db->prepare(
        'UPDATE topics
        SET first_post_id = :idPost, last_post_id = :idPost
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idPost', intval($idPost), PDO::PARAM_INT);
    $reqSelect->bindValue(':idTopic', intval($idTopic), PDO::PARAM_INT);
    $reqSelect->execute();
}
