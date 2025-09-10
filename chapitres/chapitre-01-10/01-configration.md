Chapitre 1: Configuration de l'environnement

Création du dossier du projet: "G:\web\php\forum"
Création du virtualhost dans le dossier alias de wamp:
--------------------------------------------------
<VirtualHost local.forum:80>

  ServerAdmin admin@local.forum
  ServerName local.forum
  ServerAlias local.forum

  DocumentRoot "G:/web/php/forum/public"

  <Directory "G:/web/php/forum/public">
    Options Indexes FollowSymLinks MultiViews
    AllowOverride all
    Require all granted
  </Directory>

</VirtualHost>
--------------------------------------------------

Redémarrage de wamp et ajout dans le fichier
hosts de windows du nom de domaine : "local.forum"

Ouverture du projet avec phpstorm.
