<?php

/**
 * Permet de récupèrer les informations
 * du forum par rapport à son id
 *
 * @param PDO $db
 * @param $idForum
 * @return array|false
 */
function getForumById(PDO $db, $idForum)
{
    $reqSelect = $db->prepare(
        'SELECT id, category_id, name, description, topic_count, post_count, last_post_id
        FROM forums
        WHERE id = :idForum');

    $reqSelect->bindValue(':idForum', intval($idForum), PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

/**
 * Permet de récupèrer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param $idForum
 * @param $idPost
 */
function updateForumPost(PDO $db, $idForum, $idPost)
{
    $reqSelect = $db->prepare(
        'UPDATE forums
        SET last_post_id = :idPost, post_count = `post_count` + 1
        WHERE id = :idForum');

    $reqSelect->bindValue(':idPost', intval($idPost), PDO::PARAM_INT);
    $reqSelect->bindValue(':idForum', intval($idForum), PDO::PARAM_INT);
    $reqSelect->execute();
}
