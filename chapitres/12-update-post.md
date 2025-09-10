Chapitre 12: Update des posts

Ajout des routes dans app/routes/forum.php:
--------------------------------------------------
addRoute('get', '/forums/:idForum/topics/:idTopic/posts/:idPost', 'forum/updatePost');
addRoute('post', '/forums/:idForum/topics/:idTopic/posts/:idPost', 'forum/postUpdatePost');
--------------------------------------------------

Ajout de la fonction getPostById dans
le model app/models/posts.php

Ajout d'une fonction pour générer le token
dans le fichier app/controllers/controller.php

On modifie les fichiers en conséquence :
    -> app/controllers/forum/newTopic.php
    -> app/controllers/forum/post.php

Déplacement de la fonction postedAt
dans le model app/models/posts.php

Création du fichier app/controllers/forum/updatePost.php
Création de la vue app/views/forum/updatePost.php
Création du fichier app/controllers/forum/postUpdatePost.php

Ajout de la méthode updatePost dans le model app/models/posts.php
Ajout du nl2br et du htmlentities pour le $post['content'] du forum

Vérification des droits pour les boutons avec l'ajout de la fonction checkPermit
dans le fichier app/controllers/forum/post.php
