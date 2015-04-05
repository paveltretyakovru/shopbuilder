<?php
// Автоматически создаем объекты запросов ----------------------#
Route::bind('categories' , function($category){					#
	return App\Category::whereId($category)->first();			#
});																#
Route::bind('products' , function($product){					#
	return App\Product::whereId($product)->first();				#
});																#
Route::bind('parameters' , function($product){					#
	return App\Product::whereId($product)->first();				#
});																#
Route::bind('views' , function($product){						#
	return App\Product::whereId($product)->first();				#
});																#
Route::bind('category' , function($category){					#
	$model = App\Category::where('url' , $category)->first();	#
	if ($model) {										
		return $model;
	}else{
		return false;
	}
});
// -----------------------------------------------------#

$router->get('404' , function(){
	return view('errors.404');
});

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

// Формируем контроллера административной панели
Route::get('admin', function(){
	return view('admin.index');
});

Route::group(array('namespace' => 'Admin'), function(){
	// ТОВАРЫ
	Route::resource('admin/products', 'ProductsController');

	// КАТЕГОРИИ
	Route::resource('admin/categories', 'CategoriesController');
	//Route::post('admin/categories/{products}' , 'CategoriesController@update');

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

$router->get('test', 'TestsController@test');

// Ображение к товарам из публичной части сайта
Route::get('{category}' , 'ProductsController@index');