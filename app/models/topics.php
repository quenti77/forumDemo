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
        'SELECT id, name, description, reply_count, resolved, locked
        FROM topics
        WHERE id = :idTopic');

    $reqSelect->bindValue(':idTopic', intval($idTopic), PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
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
