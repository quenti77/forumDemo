<?php

/**
 * Permet de récupérer un utilisateur
 * en fonction du nom ou du mail
 *
 * @param PDO $db
 * @param string $name
 * @param string $email
 * @return array|false
 */
function getUserByNameOrEmail(PDO $db, string $name, string $email): false|array
{
    // Récupération des champs pour la table users
    // ou le nom = $name OU l'email = $email et
    // prend en qu'un seul
    $reqSelect = $db->prepare(
        'SELECT id, name, password, email, email_token, register_at, connection_at, `rank`
        FROM users
        WHERE name = :name OR
            email = :email
        LIMIT 0, 1');

    // La fonction bindValue est plus lisible et plus précise
    $reqSelect->bindValue(':name', $name);
    $reqSelect->bindValue(':email', $email);

    // Exécution de la requête
    $reqSelect->execute();

    // On retourne le résultat
    return $reqSelect->fetch();
}

/**
 * Permet de récupérer un utilisateur par son id
 *
 * @param PDO $db
 * @param int $userId
 * @return array|false
 */
function getUserById(PDO $db, int $userId): false|array
{
    // Récupération des champs pour la table users
    // ou notre ID vaut $userId et prend en qu'un seul
    $reqSelect = $db->prepare(
        'SELECT id, name, password, email, email_token, register_at, connection_at, `rank`
        FROM users
        WHERE id = :userId
        LIMIT 0, 1');

    $reqSelect->bindValue(':userId', $userId, PDO::PARAM_INT);
    $reqSelect->execute();

    // On retourne le résultat
    return $reqSelect->fetch();
}

/**
 * Compte le nombre de comptes utilisateurs
 * au total ou seulement les comptes vérifiés
 *
 * @param PDO $db
 * @param bool $onlyChecked
 * @return int
 */
function countUsers(PDO $db, bool $onlyChecked): int
{
    $sql = 'SELECT COUNT(*) AS nbUsers FROM users';
    if ($onlyChecked) {
        $sql .= ' WHERE email_token IS NULL';
    }

    $reqSelect = $db->prepare($sql);
    $reqSelect->execute();

    $user = $reqSelect->fetch();
    return $user ? $user['nbUsers'] : 0;
}

/**
 * Inscription de l'utilisateur dans la BDD
 *
 * @param PDO $db
 * @param array $user
 * @return int L'id de l'utilisateur enregistré
 */
function registerUser(PDO $db, array $user): int
{
    $reqInsert = $db->prepare(
        'INSERT INTO users (name, password, email, email_token, register_at, connection_at, `rank`) 
        VALUES (:name, :password, :email, :emailToken, NOW(), NULL, 1)');

    $reqInsert->bindValue(':name', $user['name']);
    $reqInsert->bindValue(':password', $user['password']);
    $reqInsert->bindValue(':email', $user['email']);
    $reqInsert->bindValue(':emailToken', $user['emailToken']);
    $reqInsert->execute();

    return (int)$db->lastInsertId();
}

/**
 * Met à jour la date de connexion
 *
 * @param PDO $db
 * @param array $user
 * @return void
 */
function updateUser(PDO $db, array $user): void
{
    $reqUpdate = $db->prepare(
        'UPDATE users
        SET name = :name,
            email = :email,
            email_token = :email_token,
            connection_at = :connection_at,
            `rank` = :rank
        WHERE id = :userId');

    $reqUpdate->bindValue(':name', $user['name']);
    $reqUpdate->bindValue(':email', $user['email']);
    $reqUpdate->bindValue(':email_token', $user['email_token']);
    $reqUpdate->bindValue(':connection_at', $user['connection_at']);
    $reqUpdate->bindValue(':rank', $user['rank']);
    $reqUpdate->bindValue(':userId', $user['id'], PDO::PARAM_INT);
    $reqUpdate->execute();
}
