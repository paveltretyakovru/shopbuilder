<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;

use App\Category;
use App\Product;

class ProductsController extends Controller {

	public function index($category){
		if ($category) {
			// получаем товары по необходимой категории
			$products = Product::where('category' , $category->id)->get();
			return view('products.public.index' , compact('category' , 'products'));
		}else{
			// если категория товаров не найдена возвращаем 404
			return redirect('404');
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
