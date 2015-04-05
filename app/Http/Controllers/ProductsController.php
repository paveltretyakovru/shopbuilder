<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;

use App\Category;
use App\Product;

class ProductsController extends Controller {

	public function index($type){

		// Обращается ли пользователь к существующей категории товаров
		if ($this->checkCategory($type)) {
			return "test check";
		}else{
			// Если данной категоии нет, значит возвращаем страницу 404
			// Остальные маршруты описываются в routes.php
			return view('errors.404');
		}
	}

	/* Проверям идет ли обращение к существующей категории товаров */
	private function checkCategory($category){
		
		// Валидация категории по полю url, таблицы categories
		$validator = Validator::make(
			['url' => $category] ,
			['url' => 'required|exists:categories,url']
		);
		
		if ($validator->fails()) {
			return false;
		}else{
			return true;
		}	
	}

}
