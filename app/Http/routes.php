<?php

Route::bind('categories' , function($category){
	return App\Category::whereId($category)->first();
});

Route::bind('products' , function($product){
	return App\Product::whereId($product)->first();
});

$router->get('admin', function()
{
	return view('admin.index');
});

$router->resource('products', 'ProductsController');
$router->resource('categories', 'CategoriesController');
$router->resource('parameters', 'ParametersController' , [
		'only' => ['edit']
	]);

$router->get('/', function(){
	return view('index');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);