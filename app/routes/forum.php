<?php

// La route pour voir les topics d'un forum
addRoute('get', '/forums/:idForum', 'forum/topic');

// La route pour voir les posts d'un topic
addRoute('get', '/forums/:idForum/topics/:idTopic', 'forum/post');
