<?php

$router->resource('products', 'ProductsController');
$router->resource('categories', 'CategoriesController');

$router->get('/', function(){
	return view('index');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
