Chapitre 7: Auto reconnection et envoie du mail de confirmation

Installation de la lib phpmailer:
    - Sur le github: https://github.com/PHPMailer/PHPMailer,
    prendre les trois fichiers sources :
        -> class.phpmailer.php
        -> class.pop3.php
        -> class.smtp.php

Ouverture de maildev pour le serveur SMTP

Création du fichier app/views/mails/verify.html.php
Et création du fichier app/views/mails/verify.text.php

Modification du fichier public/index.php pour y inclure phpmailer
Modification du fichier app/controllers/account/postRegister.php

Vérification de l'envoie du mail

Reconnecter la personne si le cookie existe.
    -> Modification du fichier public/index.php

