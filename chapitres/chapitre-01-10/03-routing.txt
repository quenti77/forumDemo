Chapitre 3: Gestion des urls (routes)

Ajout du fichier .htaccess dans le dossier public:
--------------------------------------------------
# htaccess pour rédiriger vers l'application les routes
RewriteEngine On

# On redirige pour tous les fichiers et dossiers qui n'existe pas
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /index.php?url=$1
--------------------------------------------------

Début du fichier index.php dans le dossier public:
--------------------------------------------------
<?php
var_dump($_GET);
--------------------------------------------------

Une fois que l'on est bon on commence notre routing :
    - Création du fichier router.php dans le dossier app/routes
    - Création du tableau $routes
    - Création de la fonction 'trimUrl'
    - Création de la fonction 'addRoute'
    - Création de la fonction 'method'
    - Création de la fonction 'urlMatch'
    - Création de la fonction 'run'

On reviens sur le fichier index.php pour tester notre router
    -> Avec une route qui match sans paramètre
    -> Avec une route qui match sans paramètre en post
    -> Avec une route qui match avec un paramètre
    -> Avec une route qui ne match pas
