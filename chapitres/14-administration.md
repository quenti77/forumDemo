Chapitre 14: Administration du forum

Création du fichier app/routes/admin.php
--------------------------------------------------
addRoute('get', '/admin', 'admin/home');
--------------------------------------------------

Ajout dans public/index.php
--------------------------------------------------
require APP.'/routes/admin.php';
--------------------------------------------------

Création du fichier app/controllers/admin/home.php
Création du template app/views/layouts/admin.php
Création de la vue app/views/admin/home.php

Modification des models users.php, topics.php
et posts.php dans le dossier app/models
