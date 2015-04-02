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

$router->post('getImageFile' , 'FilesController@getImageFile');

$router->get('admin', function()
{
	return view('admin.index');
});

// Главная страница
$router->get('/', function(){
	return view('index');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Формируем контроллера административной панели
Route::group(array('namespace' => 'Admin'), function(){
	Route::resource('admin/products', 'ProductsController');

	// ТОВАРЫ
	Route::resource('admin/products', 'ProductsController');

	// КАТЕГОРИИ
	Route::resource('admin/categories', 'CategoriesController');

	// ПРОДУКЦИЯ
	Route::resource('admin/parameters', 'ParametersController' , [
			'only' => ['edit' , 'update']
		]);
	Route::post('admin/parameters/{products}' , 'ParametersController@update');

	// Внешний вид продукта
	Route::resource('admin/views', 'ViewsController' , [
			'only' => ['edit' , 'update']
		]);
});

/*
$router->group(array('prefix' => 'admin') , function(){
	Route::resource('categories', 'CategoriesController');
});
*/