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
