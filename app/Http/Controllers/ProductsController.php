<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use DB;
use StringView;

use App\Category;
use App\Product;
use App\Parameter;

class ProductsController extends Controller {

	public function index($category){
		if ($category) {
			$ids 	= [];
			$images = [];

			// получаем товары по необходимой категории
			$products = Product::where('category' , $category->id)->paginate(15);
			
			// собираем идентификаторы товаров
			foreach ($products as $product) {
				$ids[] = $product->id;
			}

			// собираем первые изображения товаров
			$files = DB::table('files')->where([
				'type' 		=> 'image' ,
				'group'		=> 'products'
			])->whereIn('groupid' , $ids)->get();

			foreach ($files as $file) {
				if (!array_key_exists($file->groupid, $images)) {
					$images[$file->groupid] = $file;
				}
			}

			//dd($images);

			return view('products.public.index' , compact('category' , 'products' , 'images'));
		}else{
			// если категория товаров не найдена возвращаем 404
			return redirect('404');
		}
	}

	public function show($product){
		// Добавлен ли товар в корзину
		$product_in_cart = false;

		$product 	= Product::whereId($product)->first();	

		if($product){
			$parameters = Parameter::where('product' , $product->id)->get();		

			$view 		= StringView::make(
				[
					'template' 		=> $product->view ,
					'cache_key' 	=> 'EQt5fc2CiZGz888J' ,
					'updated_at'	=> 0
				] ,
				[
					'product' 		=> $product ,
					'parameters' 	=> $parameters
				]
			);

			//return $view;
			return view('products.public.show' , compact('product' , 'parameters' , 'view' , 'product_in_cart'));			
		}else{
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
