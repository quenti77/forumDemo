## Chapitre 4 : Structure de base

Dans le fichier `home.php` dans le dossier `app/routes` on
ne garde que la route d'index `/`
```php
addRoute('get', '/', 'home/index');
```

- On ajoute le fichier `controller.php` dans `app/controllers`
- On modifie notre fichier `index.php` dans public
- On créer fichier `home/index.php` dans le dossier `app/controllers`
  - Ajout de la méthode `render`
- On créé un fichier `front.php` dans le dossier `app/views/layouts`
  - Structure de base pour le test
- On créé fichier `home/index.php` dans le dossier `app/views`
  - Petit code pour le test
- Une fois que l'on sait que ça fonctionne on peut y mettre notre vrai template HTML
- On créé le fichier model dans le dossier `app/models`
- On test le require d'un model et l'appel à une des fonctions du model
