<?php
// On supprime la case pour l'auth sur la session
unset($_SESSION['auth']);

// On supprime le cookie aussi
setcookie('remember', '', -1, '/', null, false, true);

// Une fois cela fait on peut rediriger.
// Avec un message flash
setFlash('success', 'Vous êtes maintenant déconnecté');
redirectTo('/');
