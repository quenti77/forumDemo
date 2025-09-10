## Chapitre 16 : Administration des forums

Ajout des routes dans app/routes/admin.php
```php
addRoute('post', '/admin/forums/new', 'admin/postNewForum');
addRoute('post', '/admin/forums/:idForum/edit', 'admin/postEditForum');
addRoute('post', '/admin/forums/:idForum/remove', 'admin/postRemoveForum');
```

Création des fichiers postNewForum.php, postEditForum.php et postRemoveForum.php dans le dossier app/controllers/forum
Ajout des fonctions dans les différents models
