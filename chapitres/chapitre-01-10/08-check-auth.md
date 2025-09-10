## Chapitre 8 : Modification du menu et condition d'authentification sur les pages

Lancer la possibilité au gens de le faire avant d'avoir une correction.
Le but serait :
1. De faire la partie déconnexion
2. De vérifier si la personne est connecté ou non pour la partie
   inscription et connexion et le rediriger si c'est le cas
3. De modifier le menu en fonction du status de connexion

Création de la route en get '/logout' dans le fichier app/routes/account.php :
```php
addRoute('get', '/logout', 'account/logout');
```

Création du fichier app/controllers/account/logout.php
Modification des fichiers app/controllers/account
- /login.php
- /postLogin.php
- /postRegister.php
- /register.php

Avec l'ajout de ce bout de code en haut :
```php
if (isset($_SESSION['auth'])) {
    redirectTo('/');
}
```

Ajout de ce code dans la fonction render du fichier app/controllers/controller.php :
```php
$auth = (isset($_SESSION['auth'])) ? $_SESSION['auth'] : null;
```

Modification du fichier app/views/account/layouts/front.php sur la partie du menu.
