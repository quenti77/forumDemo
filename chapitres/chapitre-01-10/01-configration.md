## Chapitre 1 : Configuration de l'environnement

Voici ce qu'il vous faut pour pouvoir lancer le projet :
- Avoir `PHP` version 8.4 d'installé
- Avoir `composer` d'installer pour la partie POO
- Avoir une DB `MySQL` accessible
  - Si vous préférez passer par `Docker`, c'est possible.

Pour aller au plus simple, le mieux reste de lancer le serveur interne de PHP :
```bash
# Depuis la racine du projet
php -S localhost:8000 -t ./public
```

Le principale, c'est d'avoir un serveur qui redirige toutes les requêtes vers le fichier `public/index.php`.
