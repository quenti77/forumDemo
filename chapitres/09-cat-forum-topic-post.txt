Chapitre 9: Afficher les catégories, les forums, les topics et les posts

Création du fichier app/routes/forum.php avec les routes
Modification du fichier public/index.php :
--------------------------------------------------
require APP.'/routes/forum.php';
--------------------------------------------------

Création des fichiers categories.php, forums.php,
topics.php et posts.php dans le dossier app/models.

Modification du fichier app/controllers/home/index.php
Création des fichiers topic.php et post.php
dans le dossier app/controllers/forum

Création des vues topic.php et post.php dans
le dossier app/views/forum
