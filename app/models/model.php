<?php

// Connexion à la base de donnée (ne pas oublier de changer les informations de connexion)
$db = new PDO('mysql:host=127.0.0.1;dbname=forum_demo;charset=utf8;port=3316', 'forum_demo', 'forum_demo');

// On défini tous les résultats sous forme d'un tableau associatif
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// On indique que les erreurs SQL seront des exceptions
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function requireModel($model)
{
    require APP.'/models/'.$model.'.php';
}
