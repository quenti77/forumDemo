## Chapitre 10 : Ajout de nouveau post et de nouveau topic

Ajout du formulaire dans la vue app/views/forum/post.php uniquement si la personne est connecté
Ajout d'une route en post dans le fichier app/routes/forum.php
```php
addRoute('post', '/forums/:idForum/topics/:idTopic', 'forum/postPost');
```

Création du fichier app/controllers/forum/postPost.php
Ajout des fonctions dans les fichiers posts.php, topics.php et forums.php du dossier app/models
