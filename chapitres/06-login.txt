Chapitre 6: Connexion et vérification adresse mail

Ajout des 2 nouvelles routes dans
le fichier app/routes/account.php :
--------------------------------------------------
addRoute('get', '/login', 'account/login');
addRoute('post', '/login', 'account/postLogin');
--------------------------------------------------

Création des fichiers login.php et postLogin.php
dans le dossier app/controllers/account

Création de la vue app/views/account/login.php
Création du fichier main.css dans le dossier public/css

On vérifie notre formulaire dans la page postLogin.php
Création de la fonction updateUser
On test que la session existe et que le cookie existe aussi

Création de la route pour la vérification du mail
dans le fichier app/routes/account.php :
--------------------------------------------------
addRoute('get', '/verify/:id-:token', 'account/checkMail');
--------------------------------------------------

Création du fichier app/controllers/account/checkMail.php
Création de la fonction getUserById dans app/models/users.php
