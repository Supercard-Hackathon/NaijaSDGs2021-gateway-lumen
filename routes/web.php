<?php

$router->get('/','main\MainController@test');

$router->post('/register','user\UserController@register');
$router->post('/login','user\UserController@login');


/**
* ROUTES THAT NEED TOKEN AUTHORIZATION OR LOGIN
*/
$router->group(['middleware' => 'client'], function() use ($router){
	// routes that start with url "gateway/"
	$router->group(['prefix' => 'gateway'], function () use ($router) {
		$router->post('organization/new', 'organization\OrganizationController@newOrganization');
		$router->post('group/new', 'group\GroupController@newGroup');
	});
});