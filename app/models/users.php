<?php

/**
 * Permet de récupérer un utilisateur
 * en fonctino du nom ou du mail
 *
 * @param PDO $db
 * @param string $name
 * @param string $email
 * @return array|false
 */
function getUserByNameOrEmail(PDO $db, $name, $email)
{
    // Récupération des champs pour la tables users
    // ou le nom = $name OU l'email = $email et
    // prends en qu'un seul
    $reqSelect = $db->prepare(
        'SELECT id, name, password, email, email_token, register_at, connection_at, rank
        FROM users
        WHERE name = :name OR
            email = :email
        LIMIT 0, 1');

    // La fonction bindValue est plus lisible et plus précise
    $reqSelect->bindValue(':name', $name, PDO::PARAM_STR);
    $reqSelect->bindValue(':email', $email, PDO::PARAM_STR);

    // Exécution de la requête
    $reqSelect->execute();

    // On retourne le résultat
    return $reqSelect->fetch();
}

/**
 * Permet de récupérer un utilisateur par son id
 *
 * @param PDO $db
 * @param $userId
 * @return array|false
 */
function getUserById(PDO $db, $userId)
{
    // Récupération des champs pour la tables users
    // ou l'id vaut $userId et prends en qu'un seul
    $reqSelect = $db->prepare(
        'SELECT id, name, password, email, email_token, register_at, connection_at, rank
        FROM users
        WHERE id = :userId
        LIMIT 0, 1');

    $reqSelect->bindValue(':userId', $userId, PDO::PARAM_INT);
    $reqSelect->execute();

    // On retourne le résultat
    return $reqSelect->fetch();
}

/**
 * Compte le nombre de compte utilisateurs
 * totale ou seulement les comptes vérifiés
 *
 * @param PDO $db
 * @param bool $onlyChecked
 * @return int
 */
function countUsers(PDO $db, $onlyChecked)
{
    $sql = 'SELECT COUNT(*) AS nbUsers FROM users';
    if ($onlyChecked) {
        $sql .= ' WHERE email_token IS NULL';
    }

    $reqSelect = $db->prepare($sql);
    $reqSelect->execute();

    $user = $reqSelect->fetch();
    if ($user) {
        return intval($user['nbUsers']);
    }
    return 0;
}

/**
 * Inscription de l'utilisateur dans la BDD
 *
 * @param PDO $db
 * @param array $user
 * @return int L'id de l'utilisateur enregistré
 */
function registerUser(PDO $db, $user)
{
    $reqInsert = $db->prepare(
        'INSERT INTO users (name, password, email, email_token, register_at, connection_at, rank) 
        VALUES (:name, :password, :email, :emailToken, NOW(), NULL, 1)');

    $reqInsert->bindValue(':name', $user['name'], PDO::PARAM_STR);
    $reqInsert->bindValue(':password', $user['password'], PDO::PARAM_STR);
    $reqInsert->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $reqInsert->bindValue(':emailToken', $user['emailToken'], PDO::PARAM_STR);
    $reqInsert->execute();

    return intval($db->lastInsertId());
}

/**
 * Met à jour la date de connexion
 *
 * @param PDO $db
 * @param array $user
 */
function updateUser(PDO $db, $user)
{
    $reqUpdate = $db->prepare(
        'UPDATE users
        SET name = :name,
            email = :email,
            email_token = :email_token,
            connection_at = :connection_at,
            rank = :rank
        WHERE id = :userId');

    $reqUpdate->bindValue(':name', $user['name'], PDO::PARAM_STR);
    $reqUpdate->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $reqUpdate->bindValue(':email_token', $user['email_token'], PDO::PARAM_STR);
    $reqUpdate->bindValue(':connection_at', $user['connection_at'], PDO::PARAM_STR);
    $reqUpdate->bindValue(':rank', $user['rank'], PDO::PARAM_STR);
    $reqUpdate->bindValue(':userId', $user['id'], PDO::PARAM_INT);
    $reqUpdate->execute();
}
