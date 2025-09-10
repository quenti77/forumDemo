## Chapitre 15 : Gestion des catégories du forum

Ajout de la route dans app/routes/admin.php
```php
addRoute('get', '/admin/forums', 'admin/forum');
addRoute('post', '/admin/categories/new', 'admin/newCategory');
addRoute('post', '/admin/categories/:idCategory/edit', 'admin/postEditCategory');
addRoute('post', '/admin/categories/:idCategory/remove', 'admin/postRemoveCategory');
```

Création du fichier app/controllers/admin/forum.php
Création de la vue app/views/admin/forum.php
Création des fichiers postNewCategory.php, postEditCateogry.php et postRemoveCategory.php dans le dossier app/controllers/forum
Ajout des fonctions dans les différents models
