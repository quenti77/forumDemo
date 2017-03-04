<?php

// Connexion à la base de donnée
try {
    $db = new PDO('mysql:host=localhost;dbname=tuto;charset=utf8', 'tuto', 'tuto');

    // On défini tous les résultats sous forme d'un tableau associatif
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // On indique que les erreurs SQL seront des exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // S'il y a eu un problème

    // On affiche le message
    var_dump($e->getMessage());

    // On termine le script ici
    exit;
}

function requireModel($model)
{
    require APP.'/models/'.$model.'.php';
}
