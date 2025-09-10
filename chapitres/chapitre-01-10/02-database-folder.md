Chapitre 2: Création de la base de données et des dossiers

Requête SQL pour la création d'un utilisateur et de sa base de données

CREATE DATABASE tuto;
CREATE USER 'tuto'@'localhost' IDENTIFIED BY 'tuto';
GRANT ALL PRIVILEGES ON tuto.* TO 'tuto'@'localhost';
FLUSH PRIVILEGES;

Création des différentes tables:
    -> voir les fichiers create.sql et data.sql

Création des différents dossiers:

forum/ (projet)
├──── app/ (notre application)
│     ├──── controllers/ (gestion de l'action)
│     ├──── models/ (gestion des données)
│     ├──── routes/ (gestion des urls
│     └──── views/ (gestion des vues)
│           └──── layout/ (nos template de pages)
│
├──── libs/ (les bibliothèque externe)
│     ├──── markdown/
│     └──── phpmailer/
│
└──── public/ (nos fichiers accessible)
      ├──── css/ (les styles)
      ├──── img/ (les images)
      ├──── js/ (les scripts JS)
      ├──── .htaccess (Seulement pour apache)
      └──── index.php (Notre point d'entré de notre application)
