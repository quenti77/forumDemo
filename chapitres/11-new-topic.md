## Chapitre 11 : Ajout de nouveau topic

Modification de la page app/views/forum/topic.php
Ajout des routes dans le fichier app/routes/forum.php
```php
addRoute('get', '/forums/:idForum/newTopic', 'forum/newTopic');
addRoute('post', '/forums/:idForum/newTopic', 'forum/postNewTopic');
```

Modification du fichier app/controllers/forum/post.php
Création des fichiers newTopic.php et postNewTopic.php dans le dossier  app/controllers/forum
