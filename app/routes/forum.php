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
