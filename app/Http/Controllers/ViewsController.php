<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Parameter;

class ViewsController extends Controller {

	public function edit(Product $product){
		$parameters = Parameter::where(['product' => $product->id])->get();
		return view('views.edit' , compact('product' , 'parameters'));
	}

	public function saveProductView(Request $request){

	}

}
