<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;
use App\Product;

class ProductsController extends Controller {

	public function index($type){
		if ($type != 'phones') {
			return view('errors.404');
		}
	}

}
