<?php

/**
 * Permet de récupérer les forums via la catégorie
 *
 * @param PDO $db
 * @param int $idCategory
 * @return PDOStatement
 */
function getForumsByCategory(PDO $db, int $idCategory): PDOStatement
{
    $reqSelect = $db->prepare(
        'SELECT id, category_id, name, description, topic_count, post_count, last_post_id
        FROM forums
        WHERE category_id = :idCategory');

    $reqSelect->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect;
}

/**
 * Permet de récupérer les informations
 * du forum par rapport à son id
 *
 * @param PDO $db
 * @param int $idForum
 * @return array|false
 */
function getForumById(PDO $db, int $idForum): false|array
{
    $reqSelect = $db->prepare(
        'SELECT id, category_id, name, description, topic_count, post_count, last_post_id
        FROM forums
        WHERE id = :idForum');

    $reqSelect->bindValue(':idForum', $idForum, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

/**
 * @param PDO $db
 * @return PDOStatement
 */
function getForums(PDO $db): PDOStatement
{
    $reqSelect = $db->prepare(
        'SELECT id, category_id, name, description, topic_count, post_count, last_post_id
        FROM forums
        ORDER BY category_id');

    $reqSelect->execute();
    return $reqSelect;
}

/**
 * Permet de récupérer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param int $idForum
 * @param int $idPost
 */
function updateForumPost(PDO $db, int $idForum, int $idPost): void
{
    $reqSelect = $db->prepare(
        'UPDATE forums
        SET last_post_id = :idPost, post_count = `post_count` + 1
        WHERE id = :idForum');

    $reqSelect->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $reqSelect->bindValue(':idForum', $idForum, PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Permet de récupérer les informations
 * du topic par rapport à son id
 *
 * @param PDO $db
 * @param int $idForum
 * @param int $idPost
 */
function updateForumTopic(PDO $db, int $idForum, int $idPost): void
{
    $reqSelect = $db->prepare(
        'UPDATE forums
        SET last_post_id = :idPost, post_count = `post_count` + 1,
            topic_count = `topic_count` + 1 
        WHERE id = :idForum');

    $reqSelect->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $reqSelect->bindValue(':idForum', $idForum, PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Change le last_post_id et le post_count
 *
 * @param PDO $db
 * @param int $idForum
 * @param int $idPost
 */
function removeForumPost(PDO $db, int $idForum, int $idPost): void
{
    $reqSelect = $db->prepare(
        'UPDATE forums
        SET last_post_id = :idPost, post_count = `post_count` - 1
        WHERE id = :idForum');

    $reqSelect->bindValue(':idPost', $idPost, PDO::PARAM_INT);
    $reqSelect->bindValue(':idForum', $idForum, PDO::PARAM_INT);
    $reqSelect->execute();
}

/**
 * Ajout d'un nouveau forum dans la DB
 *
 * @param PDO $db
 * @param int $idCategory
 * @param string $name
 * @param string $description
 * @return void
 */
function insertForum(PDO $db, int $idCategory, string $name, string $description): void
{
    $reqInsert = $db->prepare(
        'INSERT INTO forums (category_id, name, description, topic_count, post_count, last_post_id) 
        VALUES (:idCategory, :name, :description, 0, 0, NULL)');

    $reqInsert->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
    $reqInsert->bindValue(':name', $name);
    $reqInsert->bindValue(':description', $description);
    $reqInsert->execute();
}

/**
 * Modification du forum
 *
 * @param PDO $db
 * @param int $idForum
 * @param int $idCategory
 * @param string $name
 * @param string $description
 * @return void
 */
function updateForum(PDO $db, int $idForum, int $idCategory, string $name, string $description): void
{
    $reqInsert = $db->prepare(
        'UPDATE forums
        SET category_id = :idCategory,
            name = :name,
            description = :description
        WHERE id = :idForum');

    $reqInsert->bindValue(':idForum', $idForum, PDO::PARAM_INT);
    $reqInsert->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
    $reqInsert->bindValue(':name', $name);
    $reqInsert->bindValue(':description', $description);
    $reqInsert->execute();
}

/**
 * Suppression des forums via la catégory
 *
 * @param PDO $db
 * @param int $categoryId
 */
function deleteForums(PDO $db, int $categoryId): void
{
    $reqDelete = $db->prepare('DELETE FROM forums WHERE category_id = :categoryId');
    $reqDelete->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $reqDelete->execute();
}

/**
 * Suppression des forums via la catégory
 *
 * @param PDO $db
 * @param int $forumId
 */
function deleteForum(PDO $db, int $forumId): void
{
    $reqDelete = $db->prepare('DELETE FROM forums WHERE id = :forumId');
    $reqDelete->bindValue(':forumId', $forumId, PDO::PARAM_INT);
    $reqDelete->execute();
}
