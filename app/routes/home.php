<?php

addRoute('get', '/', 'home');
addRoute('post', '/', 'postHome');
addRoute('get', '/user/:name', 'profile');
