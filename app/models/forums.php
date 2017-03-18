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
 * @param PDO $db
 * @return PDOStatement
 */
function getForums(PDO $db)
{
    $reqSelect = $db->prepare(
        'SELECT id, category_id, name, description, topic_count, post_count, last_post_id
        FROM forums
        ORDER BY category_id');
    $reqSelect->execute();

    return $reqSelect;
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

function insertForum(PDO $db, $idCategory, $name, $description)
{
    $reqInsert = $db->prepare(
        'INSERT INTO forums (category_id, name, description, topic_count, post_count, last_post_id) 
        VALUES (:idCategory, :name, :description, 0, 0, NULL)');

    $reqInsert->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
    $reqInsert->bindValue(':name', $name, PDO::PARAM_STR);
    $reqInsert->bindValue(':description', $description, PDO::PARAM_STR);
    $reqInsert->execute();
}

function updateForum(PDO $db, $idForum, $idCategory, $name, $description)
{
    $reqInsert = $db->prepare(
        'UPDATE forums
        SET category_id = :idCategory,
            name = :name,
            description = :description
        WHERE id = :idForum');

    $reqInsert->bindValue(':idForum', $idForum, PDO::PARAM_INT);
    $reqInsert->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
    $reqInsert->bindValue(':name', $name, PDO::PARAM_STR);
    $reqInsert->bindValue(':description', $description, PDO::PARAM_STR);
    $reqInsert->execute();
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

/**
 * Suppression des forums via la catégory
 *
 * @param PDO $db
 * @param $forumId
 */
function deleteForum(PDO $db, $forumId)
{
    $reqDelete = $db->prepare('DELETE FROM forums WHERE id = :forumId');
    $reqDelete->bindValue(':forumId', $forumId, PDO::PARAM_INT);
    $reqDelete->execute();
}
