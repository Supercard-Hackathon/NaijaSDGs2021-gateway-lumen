<?php

$router->get('/','main\MainController@test');

$router->post('/register','user\UserController@register');
$router->post('/login','user\UserController@login');