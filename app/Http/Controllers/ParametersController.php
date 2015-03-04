<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Parameter;

class ParametersController extends Controller {

	public function edit(Product $product)
	{
		$category 		= Category::findOrFail($product->category);
		$productparams 	= Parameter::where('product' , $product->id)->get()->toArray();
		$issetparameters= array();

		foreach ($productparams as $parameter) {
			$issetparameters[$parameter['title']] = $parameter['value'];
		}

		//dd(snake_case('testGoogle'));

		$parameters 	= explodeParameters($category->parameters);
		
		return view('parameters.edit' , compact('product' , 'parameters' , 'issetparameters'));
	}

	public function update(Request $request , Product $product)
	{
		$parameters = explodeParameters(Category::findOrFail($product->category)->parameters);
		$post 		= $request->all();

		// Удаляем параметр _token
		array_pull($post , '_token');

		// Рекурсивно добавляем параметры
		foreach($post as $key => $value) {

			$control = Parameter::where( [ 'title' => $key , 'product' => $product->id ] )->first();

			// Если параметр продукта уже есть в БД, обновляем значение
			if ($control) {
				// Ну конечно же проверка, чтобы лишний раз не обращаться к БД
				if($control->value !== $value){
					$control->value = $value;

					$control->save();
				}
			}else{
				if(!empty($value)){
					$parameter 				= new Parameter;
					$parameter->title 		= $key;
					$parameter->value 		= $value;
					$parameter->product 	= $product->id;
					$parameter->category 	= $product->category;

					$parameter->save();
				}				
			}

		}

		// возвращаемся на предыдущую страницу
		return redirect()->back();
	}

}
