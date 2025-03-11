<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Parameter;

class ViewsController extends Controller {

	public function edit(Product $product){
		$parameters = Parameter::where(['product' => $product->id])->get();

		// Возвращаем пустую строку, если отсутствует, иначе удаляем каретки перевода строки
		function processVar($var){
			return (!empty($var)) ? str_replace(["\r\n", "\r", "\n"], '', $var) : '""';
		}

		$product->view 		= processVar($product->view);
		$product->editview 	= processVar($product->editview);
		
		return view('views.edit' , compact('product' , 'parameters'));
	}

	public function saveProductView(Request $request){

	}

}
