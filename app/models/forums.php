<?php

/**
 * Permet de récupèrer les forums via la catégorie
 *
 * @param PDO $db
 * @param $idCategory
 * @return PDOStatement
 */
function getForumsByCategory(PDO $db, $idCategory)
{
    $reqSelect = $db->prepare(
        'SELECT id, category_id, name, description, topic_count, post_count, last_post_id
        FROM forums
        WHERE category_id = :idCategory');

    $reqSelect->bindValue(':idCategory', intval($idCategory), PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect;
}

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

/**
 * Permet de récupèrer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param $idForum
 * @param $idPost
 */
function updateForumTopic(PDO $db, $idForum, $idPost)
{
    $reqSelect = $db->prepare(
        'UPDATE forums
        SET last_post_id = :idPost, post_count = `post_count` + 1,
            topic_count = `topic_count` + 1 
        WHERE id = :idForum');

    $reqSelect->bindValue(':idPost', intval($idPost), PDO::PARAM_INT);
    $reqSelect->bindValue(':idForum', intval($idForum), PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Change le last_post_id et le post_count
 *
 * @param PDO $db
 * @param $idForum
 * @param $idPost
 */
function removeForumPost(PDO $db, $idForum, $idPost)
{
    $reqSelect = $db->prepare(
        'UPDATE forums
        SET last_post_id = :idPost, post_count = `post_count` - 1
        WHERE id = :idForum');

    $reqSelect->bindValue(':idPost', intval($idPost), PDO::PARAM_INT);
    $reqSelect->bindValue(':idForum', intval($idForum), PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Suppression des forums via la catégory
 *
 * @param PDO $db
 * @param $categoryId
 */
function deleteForums(PDO $db, $categoryId)
{
    $reqDelete = $db->prepare('DELETE FROM forums WHERE category_id = :categoryId');
    $reqDelete->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $reqDelete->execute();
}
