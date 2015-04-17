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
		$products 	= array();
		$ids 		= array();
		$images 	= array();
		$prices		= array();
		$carts 		= $this->getUserCarts();
		$sum 		= 0;

		if (count($carts)) {
			foreach ($carts as $cart) {
				$product = Cart::find($cart->id)->product;				
				array_push($products, $product);
				array_push($ids, $product->id);
				array_push($prices, $product->price);
			}
		}

		$sum = array_sum($prices);

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

		return view('shop.cart' , compact('carts' , 'products' , 'images' , 'sum'));
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

	protected function getUserCarts(){
		if(Auth::check()){
			$user 	= Auth::user();
			$carts 	= Cart::where(['user_id' => $user->id]);

			if($carts){
				return $carts->get();
			}else{
				return false;
			}

		}else{
			if(Session::has('cart')){
				$carts = array();

				foreach (Session::get('cart') as $product_id) {
					$cart = Cart::find($product_id);

					if ($cart) {
						array_push($carts, $cart);
					}
				}

				return $carts;
			}
		}
	}

}
