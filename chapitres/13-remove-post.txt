Chapitre 13: suppression des posts

Ajout de la route dans app/routes/forum.php:
--------------------------------------------------
addRoute('post', '/forums/:idForum/topics/:idTopic/posts/:idPost/remove', 'forum/postRemovePost');
--------------------------------------------------

Création du fichier app/controllers/forum/postRemovePost.php
