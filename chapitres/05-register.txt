Chapitre 5: Inscription au site

Création des routes nécessaire dans
le fichier account.php dans app/routes

Création du fichier register.php et postRegister.php
dans le nouveau dossier app/controllers/account

Ajout de la fonction sessionPost dans le
fichier app/controllers/controller.php

On rend la page dans le fichier register.php
du dossier app/controllers/account

On écrit la vue avec le formulaire d'inscription dans
un nouveau fichier account/register.php du dossier app/views
sans les valeurs du formulaire en cas d'erreur

On créé le fichier users dans le dossier app/models

On fait les vérification du formulaire dans le fichier
postRegister.php du dossier app/controllers/account

Arrivée à l'erreur 6 on créé la fonction getUserByNameOrEmail
dans le fichier app/models/users.php

Arrivée au if empty sur les erreurs on doit créer 3 fonctions.
La première pour faire des redirections via les en-têtes
La seconde pour enregistrer les messages flash dans la session
Et la dernière pour mettre en forme les erreurs et sauvegarder le formulaire

La première fonction est dans le fichier app/routes/router.php
et les 2 autres dans le fichier app/controllers/controller.php

On reviens sur notre contrôleur app/controllers/account/postRegister.php
dans le if else des erreurs

Ajout de la fonction registerUser dans app/models/users.php

Ajout du code pour le message flash juste avant le contenu
--------------------------------------------------
<?php $flash = (isset($_SESSION['flash'])) ? $_SESSION['flash'] : null; ?>
<?php if ($flash): ?>
    <?php unset($_SESSION['flash']); ?>
    <div class="alert alert-dismissible alert-<?= $flash['type'] ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?= $flash['content'] ?>
    </div>
<?php endif; ?>
--------------------------------------------------
