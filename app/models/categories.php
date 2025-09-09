<?php

/**
 * Permet de sélectionner les informations pour les
 * catégories, les forums et le dernier post du forum
 *
 * @param PDO $db
 * @return PDOStatement
 */
function getCategoriesAndForums(PDO $db): PDOStatement
{
    $reqSelect = $db->prepare(
        'SELECT C.id AS category_id, C.name AS category_name, C.sorted,
        # forums
        F.id AS forum_id, F.name AS forum_name, F.description, F.topic_count, F.post_count,
        # last post
        P.id AS post_id, P.posted_at, P.resolved, P.topic_id,
        # user
        U.id AS user_id, U.name AS user_name
        FROM categories AS C
        LEFT JOIN forums AS F
            ON F.category_id = C.id
        LEFT JOIN posts AS P
            ON P.id = F.last_post_id
        LEFT JOIN users AS U
            ON U.id = P.user_id
        ORDER BY C.sorted, C.id, forum_id');

    $reqSelect->execute();
    return $reqSelect;
}

/**
 * @param PDO $db
 * @return PDOStatement
 */
function getCategories(PDO $db): PDOStatement
{
    $reqSelect = $db->prepare('SELECT id, name, sorted FROM categories ORDER BY sorted DESC');
    $reqSelect->execute();

    return $reqSelect;
}

/**
 * @param PDO $db
 * @param int $idCategory
 * @return array|false
 */
function getCategory(PDO $db, int $idCategory): false|array
{
    $reqSelect = $db->prepare('SELECT id, name, sorted FROM categories WHERE id = :idCategory');
    $reqSelect->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
    $reqSelect->execute();

    return $reqSelect->fetch();
}

/**
 * Ajout d'une nouvelle catégorie
 *
 * @param PDO $db
 * @param string $name
 * @param int $order
 */
function insertCategory(PDO $db, string $name, int $order): PDOStatement
{
    $reqInsert = $db->prepare('INSERT INTO categories (name, sorted) VALUES (:name, :order)');
    $reqInsert->bindValue(':name', $name, PDO::PARAM_STR);
    $reqInsert->bindValue(':order', $order, PDO::PARAM_INT);
    $reqInsert->execute();
}

/**
 * Modification d'une catégorie
 *
 * @param PDO $db
 * @param int $idCategory
 * @param string $name
 * @param int $order
 */
function updateCategory(PDO $db, int $idCategory, string $name, int $order): void
{
    $reqInsert = $db->prepare('UPDATE categories SET name = :name, sorted = :order WHERE id = :idCategory');
    $reqInsert->bindValue(':name', $name, PDO::PARAM_STR);
    $reqInsert->bindValue(':order', $order, PDO::PARAM_INT);
    $reqInsert->bindValue(':idCategory', $idCategory, PDO::PARAM_INT);
    $reqInsert->execute();
}

/**
 * Suppression de la catégorie
 *
 * @param PDO $db
 * @param int $categoryId
 */
function deleteCategory(PDO $db, int $categoryId): void
{
    $reqDelete = $db->prepare('DELETE FROM categories WHERE id = :categoryId');
    $reqDelete->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $reqDelete->execute();
}
