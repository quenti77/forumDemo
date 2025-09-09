<?php

// La route pour voir les topics d'un forum
addRoute('get', '/forums/:idForum', 'forum/topic');

// La route pour voir les posts d'un topic
addRoute('get', '/forums/:idForum/topics/:idTopic', 'forum/post');

// Ajout d'un post au topic
addRoute('post', '/forums/:idForum/topics/:idTopic', 'forum/postPost');

// Formulaire d'ajout de topic
addRoute('get', '/forums/:idForum/newTopic', 'forum/newTopic');
addRoute('post', '/forums/:idForum/newTopic', 'forum/postNewTopic');

// Mise à jour d'un post
addRoute('get', '/forums/:idForum/topics/:idTopic/posts/:idPost/update', 'forum/updatePost');
addRoute('post', '/forums/:idForum/topics/:idTopic/posts/:idPost/update', 'forum/postUpdatePost');

// Résoudre ou non un topic
addRoute('post', '/forums/:idForum/topics/:idTopic/posts/:idPost/resolve', 'forum/resolvePost');

// Suppression d'un post
addRoute('post', '/forums/:idForum/topics/:idTopic/posts/:idPost/remove', 'forum/postRemovePost');
