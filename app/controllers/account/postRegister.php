<?php

/**
 * Vérification du formulaire pour l'inscription
 */

// On charge notre model pour les utilisateurs
requireModel('users');

// On récupère nos variables du formulaire
// grâce à la fonction getParam
$name = getParam('name');
$email = getParam('email');
$pass = getParam('pass');
$pass_confirm = getParam('pass_confirm'); // Le seul moment ou je mets un _ dans une variable

// On gère nos erreurs possible via ce tableau
$errors = [];

/**
 * Quelles sont les erreurs possibles :
 *  01 L'un des champs obligatoire n'est pas remplie
 *  02 Le pseudo n'est pas une chaine compris
 *    entre 3 et 50 caractères
 *  03 Le mail n'est pas dans un format valide
 *  04 Le mot de passe fait moins de 8 caractères
 *  05 Les mots de passe ne sont pas identiques
 *  06 Le pseudo ou le mail existe déjà en BDD
 */

// Erreur 01:
if (empty($name) || empty($email) ||
    empty($pass) || empty($pass_confirm)) {

    // Si l'un des champs obligatoire est vide
    // c'est qu'il est pas remplie
    $errors[] = 'Tous les champs doivent être remplis';
}

// Erreur 02:
// Meusure de la taille de la chaine
$nameLength = strlen($name);

if ($nameLength < 3 || $nameLength > 50) {
    // Ce n'est pas bon car soit en dessous de 3 soit au dessus de 50
    $errors[] = 'Votre pseudo doit être compris entre 3 et 50 caractères';
}

// Erreur 03:
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Explication de la fonction
    $errors[] = 'Votre email est dans un format invalide';
}

// Erreur 04:
$passLength = strlen($pass);

// On ne vérifie que sur le premier mot de passe car
// on test après si les valeurs sont identiques
if ($passLength < 8) {
    $errors[] = 'Votre mot de passe n\'est pas assez long (8 caractères minimum)';
}

// Erreur 05:
if ($pass != $pass_confirm) {
    $errors[] = 'Vos mots de passe ne sont pas identique';
}

// Erreur 06:
// Pour vérifier que un utilisateur existe ou pas
// le plus simple est de le chercher et si on trouve
// un résultat c'est pas bon car c'est qu'il existe déjà
$user = getUserByNameOrEmail($db, $name, $email);

// le fetch dans la fonction retourne soit false soit un tableau
// donc on peut détecter si un utilisateur est pris ou non
if ($user) {
    // Explication de la syntaxe et ajout de l'erreur
    $errors[] = 'Un compte existe déjà avec le pseudo ou le mail que vous avez choisi';
}

// Une fois toutes les erreurs vérifié
// on regarde s'il y en a eu ou non
if (empty($errors)) {
    // Aucune erreur

    // On mets dans un tableau les données que l'on veut inscrire
    // Il s'agit donc d'une représentation.

    // On remplace notre variable user d'avant mais c'est
    // pas grave car on en veut plus
    $user = [
        'name' => $name,
        'password' => password_hash($name.'#-$'.$pass, PASSWORD_BCRYPT, ['cost' => 12]),
        'email' => $email,
        'emailToken' => sha1(uniqid().'---'.time())
    ];

    // On enregistre notre utilisateur
    // On on y sauvegarde l'id
    $user['id'] = registerUser($db, $user);

    // On redirige vers la page d'accueil
    setFlash('success', 'Un mail de confirmation vous a été envoyé');
    redirectTo('/');
} else {
    // Des erreurs
    setErrors($errors, compact('name', 'email'));
    redirectTo('/register');
}