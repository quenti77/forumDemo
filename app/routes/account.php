<?php

// Inscription
addRoute('get', '/register', 'account/register');
addRoute('post', '/register', 'account/postRegister');

// Connexion
addRoute('get', '/login', 'account/login');
addRoute('post', '/login', 'account/postLogin');

// Vérification de l'adresse mail
addRoute('get', '/verify/:id-:token', 'account/checkMail');
