## Chapitre 2 : Création de la base de données et des dossiers

Requête SQL pour la création d'un utilisateur et de sa base de données
```sql
CREATE DATABASE tuto;
CREATE USER 'tuto'@'localhost' IDENTIFIED BY 'tuto';
GRANT ALL PRIVILEGES ON tuto.* TO 'tuto'@'localhost';
FLUSH PRIVILEGES;
```

Une fois la base de données crée, vous pouvez importer la structure et les données via les fichiers :
- `create.sql`
- `data.sql`

Création des différents dossiers :
```
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
```
