<?php

// Notre page d'accueil de l'administration
addRoute('get', '/admin', 'admin/home');

// Notre page pour gérer les forums/catégories
addRoute('get', '/admin/forums', 'admin/forum');

// Ajout d'une catégorie
addRoute('post', '/admin/categories/new', 'admin/postNewCategory');

// Modification d'une catégorie
addRoute('post', '/admin/categories/:idCategory/edit', 'admin/postEditCategory');

// Suppression d'une catégorie
addRoute('post', '/admin/categories/:idCategory/remove', 'admin/postRemoveCategory');

// Ajout d'un forum
addRoute('post', '/admin/forums/new', 'admin/postNewForum');

// Modification d'un forum
addRoute('post', '/admin/forums/:idForum/edit', 'admin/postEditForum');

// Suppression d'un forum
addRoute('post', '/admin/forums/:idForum/remove', 'admin/postRemoveForum');
