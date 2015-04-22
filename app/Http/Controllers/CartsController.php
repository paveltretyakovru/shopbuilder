<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Cart;
use App\Product;
use Auth;
use Session;
use DB;


class CartsController extends Controller {

	public function deleteCart($cart_id){
		$cart_id 	= (integer) $cart_id;
		$dbcart 	= $this->dbCart($cart_id);

		if($dbcart){
			if (!empty($dbcart['cart'])) {
				if($dbcart['cart']->delete()){
					return redirect()->back();
				}else{
					return redirect()->back()->with('error' , "Произошла ошибка во время удаления записи");
				}
			}
		}else{
			if($this->sessionCart($cart_id) !== false){

			}
		}
		
	}

	public function addProduct($product_id){
		
		$user_id 	= (Auth::check()) 		? 	Auth::user()->id 					: 0;
		$product_id = (!empty($product_id)) ? 	(integer) $product_id 				: false;		
		$product 	= ($product_id) 		? 	Product::find($product_id)		 	: false;

		// существует ли товар
		if ($product) {
			if(!$this->existCart($product_id)){
				// если пользователь авторизон, дополнительно сохраняем корзину в БД
				if($user_id){
					$cart = new Cart;

					$cart->product_id 	= $product_id;
					$cart->user_id 		= $user_id;

					$cart->save();

				}

				// Заполняем корзину сессии
				$session_cart = Session::get('cart', []);;
				
				if(!in_array($product_id, $session_cart)){
					Session::push('cart', $product_id);
				}

				return redirect()->back()->with('success' , "Товар добален в корзину");
			}else{
				return redirect()->back()->with('info' , 'Товар уже добавлен в коризну');
			}
		}else{
			return redirect()->back()->with('error' , 'Такого товара не существует!');
		}
		
	}


	public function index(){		
		$cart_data	= $this->getCartData();
		$products	= $cart_data['products'];
		$images 	= $cart_data['images'];
		$sum 		= $cart_data['sum'];

		return view('shop.cart' , compact('products' , 'images' , 'sum'));
	}


	/*
		# Функция проверяет, добавлял ли данный товар пользователь себе в корзину
	*/
	protected function existCart($product_id){
		if(Auth::check()){
			$user = Auth::user();
			$cart = Cart::where(['product_id' => $product_id , 'user_id' => $user->id]);

			if($cart){
				if($cart->count()){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}

		}else{
			if(Session::has('cart')){
				if(in_array($product_id, Session::get('cart'))){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}

	protected function getCartData(){
		$result['products']	= array();
		$result['images'] 	= array();
		$prices				= array();		
		$ids		 		= array();		

		if(Auth::check()){
			$user 	= Auth::user();
			$carts 	= Cart::where(['user_id' => $user->id , 'checkout' => 0]);

			if($carts){
				$result['header'] 	= 'db';
				$carts = $carts->get();

				if (count($carts)) {					
					foreach ($carts as $cart) {
						$product = Cart::find($cart->id)->product;				
						array_push($result['products'], $product);
						array_push($prices, $product->price);
						array_push($ids, $product->id);
					}
				}

			}else{
				return false;
			}

		}else{
			if(Session::has('cart')){
				$carts 				= array();
				$result['header'] 	= 'session';

				foreach (Session::get('cart') as $product_id) {

					$product = Product::find($product_id);					

					if ($product) {						
						//$product = $product->get();
						array_push($result['products'], $product);
						array_push($prices, $product->price);
						array_push($ids, $product->id);
					}
				}				
			}
		}

		$result['sum'] = array_sum($prices);

		// собираем первые изображения товаров
		$files = DB::table('files')->where([
			'type' 		=> 'image' ,
			'group'		=> 'products'
		])->whereIn('groupid' , $ids)->get();

		foreach ($files as $file) {
			if (!array_key_exists($file->groupid, $result['images'])) {
				$result['images'][$file->groupid] = $file;
			}
		}

		return $result;
	}

	// Есть ли корзина в сессии
	protected function sessionCart($cart_id){
		if(Session::has('cart')){
			return array_search($cart_id, Session::get('cart'));
		}else{
			return false;
		}
	}

	// Есть ли корзина в сессии
	protected function dbCart($cart_id){
		if(Auth::check()){
			$user 	= Auth::user();
			$cart 	= Cart::where(['id' => $cart_id , 'user_id' => $user->id]);
			$dbcart = array();

			if($cart){
				if ($cart->count()) {
					$dbcart['user'] = $user;
					$dbcart['cart'] = $cart;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

}
