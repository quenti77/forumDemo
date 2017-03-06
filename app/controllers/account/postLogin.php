<?php

/**
 * Vérification du formulaire de connexion
 */

// Notre model users
requireModel('users');

// Nos champs du formulaire
$name = getParam('name');
$pass = getParam('pass');
$remember = getParam('remember');

// Nos erreurs
$errors = [];

/**
 * Quelles sont nos erreurs possible :
 *  01 L'un des champs obligatoire n'est pas remplie
 *  02 L'utilisateur n'existe pas
 *  03 Le mot de passe n'est pas bon
 *  04 Le compte n'est pas activé
 */

// Erreur 01:
if (empty($name) || empty($pass)) {
    $errors[] = 'Tous les champs doivent être remplis';
}

// Erreur 02 et 03:
// Notre champs name est pour le pseudo ou le mail
$user = getUserByNameOrEmail($db, $name, $name);

// Aucun utilisateur trouvé ou mdp incorrect
if ($user === false || !password_verify($user['name'].'#-$'.$pass, $user['password'])) {
    $errors[] = 'Vos identifiants sont incorrect';
}

// Errreur 04:
// Cette erreur ne doit être vérifié que si il n'y a pas d'erreur avant
if (empty($errors) && $user['email_token'] != null) {
    $errors[] = 'Votre compte n\'est pas actif. Merci de vérifier votre adresse mail';
}

if (empty($errors)) {
    // On est bon on peut le connecter

    // On regarde si on doit créer un cookie pour le "souvenir de moi"
    if (!empty($remember)) {
        // On génère le token pour le cookie
        $token = $user['id'].'---'.hash('sha512', $user['name'].'#~!*$'.$user['password']);
        setcookie('remember', $token, time() + 3600 * 24 * 7, '/', null, false, true);
    }

    // Pour être "connecté" c'est qu'il faut avoir dans la session une case
    // qui stocke une information le concernant.

    // On va donc sauvegarder notre tableau $user qui
    // correspond à l'utilisateur trouvé en bdd
    // Sauf que l'on ne prends pas le mot de passe
    unset($user['password']);

    // Et on doit y update la date de connexion
    $connectedAt = (new DateTime())->format('Y-m-d H:i:s');
    $user['connection_at'] = $connectedAt;
    updateUser($db, $user);

    $_SESSION['auth'] = $user;

    // Une fois fais on affiche un message flash de success et ou redirige
    setFlash('success', 'Un mail de confirmation vous a été envoyé');
    redirectTo('/');
} else {
    // Des erreurs
    setErrors($errors, compact('name'));
    redirectTo('/login');
}
