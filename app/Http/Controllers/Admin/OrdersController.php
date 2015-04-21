<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\Parameter;
use App\Order;

class OrdersController extends Controller {

	public function index(){
		return view('orders.admin.index');
	}

}
