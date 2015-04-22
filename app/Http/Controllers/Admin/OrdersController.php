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

	public function postSaveorder(Request $req){
		$order_id = $req->input('order_id');

		$order = Order::find($order_id);

		if($order){					
			$order->status = $req->input('status');
			
			if($order->save()){
				echo "Изменения записаны";
			}else{
				echo "Ошибка во время записи";
			}
		}
	}

	public function getGetorders(){
		$return = array();

		$orders = Order::all();
		foreach ($orders as $order) {
			$item 		= array();			
			$user 		= json_decode($order->user_data);
			$product 	= $order->product;

			$item['order_id']		= $order->id;
			$item['user_fullname'] 	= $user->fullname;
			$item['user_phone'] 			= $user->phone;
			$item['product_id'] 	= $order->product_id;
			$item['product_title'] 	= $product->title;
			$item['product_price']			= $product->price;
			$item['created_at'] 	= date("Y-m-d H:i:s" , strtotime($order->created_at));
			
			switch ($order->status) {
				case 'checkout':
					$item['status']	= "Оформлен";
					break;

				case 'confirmed':
					$item['status']	= "Подтвержден";
					break;

				case 'paid':
					$item['status']	= "Оплачен";
					break;
				
				default:
					# code...
					break;
			}			

			array_push($return, $item);
		}

		$return = json_encode($return , JSON_UNESCAPED_UNICODE);

		return $return;		
	}

}
