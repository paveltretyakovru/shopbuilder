<?php
Route::bind('categories' , function($category){
	return App\Category::whereId($category)->first();
});

Route::bind('products' , function($product){
	return App\Product::whereId($product)->first();
});

Route::bind('parameters' , function($product){
	return App\Product::whereId($product)->first();
});

Route::bind('views' , function($product){
	return App\Product::whereId($product)->first();
});

$router->get('admin', function()
{
	return view('admin.index');
});

// ТОВАРЫ
$router->resource('products', 'ProductsController');

// КАТЕГОРИИ
$router->resource('categories', 'CategoriesController');

// ПРОДУКЦИЯ
$router->resource('parameters', 'ParametersController' , [
		'only' => ['edit' , 'update']
	]);
$router->post('parameters/{products}' , 'ParametersController@update');

// Внешний вид продукта
$router->resource('views', 'ViewsController' , [
		'only' => ['edit' , 'update']
	]);

// Главная страница
$router->get('/', function(){
	return view('index');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);