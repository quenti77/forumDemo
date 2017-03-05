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
