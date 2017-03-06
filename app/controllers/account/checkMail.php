<?php

/**
 * Permet de vérifier que le mail est bon
 * via la transmission de l'id et du token
 *
 * N'est bon que pour une durée limité
 * 10 minutes pour l'exemple
 */

// Notre model users
requireModel('users');

// On récupère nos paramètres
$id = getParam('id');
$token = getParam('token');

// Récupératin de l'utilisateur via son id
$user = getUserById($db, $id);

/**
 * Quelles sont nos erreurs possible :
 *  01 L'utilisateur n'a pas le bon id ou token
 *  02 Le token a expiré
 */
$errors = [];

// Erreur 01:
if ($user === false || $user['email_token'] != $token) {
    $errors[] = 'Le token n\'est pas valide';
}

// Erreur 02:
if (empty($errors)) {
    // On défini notre date limite
    $limit = new DateTime('-10 minute');

    // On transforme la date mysql en un objet DateTime
    $register = DateTime::createFromFormat('Y-m-d H:i:s', $user['register_at']);

    // Si la limite est supérieur à la date d'inscription
    // c'est que on a dépassé le temps pour la vérification
    if ($limit > $register) {
        $errors[] = 'Le token associé à cette adresse a expiré';
    }
}

if (empty($errors)) {
    // On update le token de l'utilisateur
    $user['email_token'] = null;
    updateUser($db, $user);

    setFlash('success', 'Confirmation réussi. Vous pouvez vous connecter.');
} else {
    setErrors($errors, []);
}

redirectTo('/login');
