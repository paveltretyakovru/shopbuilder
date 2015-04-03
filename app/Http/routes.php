<?php
// Автоматически создаем объекты запросов --------------#
Route::bind('categories' , function($category){			#
	return App\Category::whereId($category)->first();	#
});														#
Route::bind('products' , function($product){			#
	return App\Product::whereId($product)->first();		#
});														#
Route::bind('parameters' , function($product){			#
	return App\Product::whereId($product)->first();		#
});														#
Route::bind('views' , function($product){				#
	return App\Product::whereId($product)->first();		#
});														#
// -----------------------------------------------------#

// Запрос с загрузкой изображения
$router->post('getImageFile' , 'FilesController@getImageFile');

// Главная страница
$router->get('/', function(){
	return view('phones.index');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

$router->get('admin', function(){
	return "hello wolrd";
	return view('admin.index');
});

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