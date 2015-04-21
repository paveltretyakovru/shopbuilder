<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// not auto include
use Auth;
use Session;
use Validator;
use \App\Cart;
use \App\User;
use \App\Order;
use \App\Product;

/*
	# class OrdersController
	# Необходимо поработать над безопасностью данного контроллера!!!
*/

class OrdersController extends Controller {

	public function getCheckout($product_id = 0){

		// Проверяем прошёл ли пользователь стадию проверки контакнтых данных
		if(Session::has('check_data') && Session::get('check_data')){
			
			$product 	= $this->getProduct($product_id);
			$user 		= $this->getUserData();			

			// если идет сразу оформление товара
			if ($product){

				// Создаем запись заказа
				if ($this->createProductOrder($user , $product->id)) {
					return view('shop.checkout')->with('success' , 'Запись успешно добавлена');
				} else {
					return view('shop.checkout')->with('error' , 'Произошла ошибка во время оформления заказа');
				}				

			// если идет оформление покупки из корзины
			}else{
				$cart_data = $this->getCartData();
				if(count($cart_data['carts'])){
					for ($i=0; $i < count($cart_data['carts']); $i++) {
						$this->createProductOrder($user , $cart_data['products'][$i]->id , $cart_data['carts'][$i]);
						$this->closeCartRecord($cart_data['carts'][$i]);
					}
				}

				if($cart_data['header'] == 'session'){
					if(Session::has('cart')){
						Session::forget('cart');
					}
				}

				return view('shop.checkout')->with('success' , 'Запись успешно добавлена');
			}

		}else{
			return redirect('/order/checkdata');
		}	
	}

	protected function createProductOrder($user , $product_id , $cart_id = NULL){
		$order 		= new Order;

		if(!empty($user['object'])){
			$order->user_id 	= $user['object']->id;
			$order->user_data 	= $user['json'];				
		}else{
			return redirect('/order/checkdata');
		}

		$order->product_id = $product_id;
		$order->cart_id    = $cart_id;

		return $order->save();
	}

	protected function closeCartRecord($cart_id){
		if($cart_id){
			$cart = Cart::find($cart_id);
			if($cart){
				$cart->checkout = true;
				$cart->save();
			}
		}
	}

	/*	
		# Страница для подтверждения контактных данных пользователя
		# Если данные не введены, добавляет в шаблон форму для их ввода
	*/
	public function getCheckdata($product_id = 0){
		// Ищем информацию о пользователе в БД и Сессии
		$user	= $this->getUserData();
		// Выводим форму 
		return view('shop.checkuserdata' , compact('user' , 'product_id'));
	}

	/*
		# Отправка формы с подтверждением контактных данных пользователя
	*/
	public function patchConfirmdata(Requests\UserDataRequest $req , $product_id = 0){
		if(Auth::check()){
			$user = Auth::user();
			$user->fill($req->input())->save();
		}else{
			$user = new User();
			$user->fill($req->input());
			Session::put('user_data', $user->toArray());
		}

		// Одноразовя переменная, обозначает, что пользователь и сервер проверили
		// контактные данные. Предотвращает поступление пустых заказов
		Session::flash('check_data', true);

		// перенаправляем на страницу с результатом оформленых товаров
		if ($product_id) {
			return redirect('order/checkout/'.$product_id);
		} else {
			return redirect('order/checkout');
		}
		
	}

	/*
		# Функция валидирует информацию пользоватлея		
	*/
	protected function validateUserData($user_data){
		// Правила данных пользователя получаем из расширения
		$rules = new Requests\UserDataRequest();
		$rules = $rules->rules();

		return Validator::make($user_data , $rules);
	}

	protected function getUserData(){
		$user_data = [
			'object' 	=> '' ,
			'json'		=> '' ,
			'array'		=> []
		];

		if(Auth::check()){
			$user_data['object'] 	= Auth::user();
			$user_data['array']		= $user_data['object']->toArray();
			$user_data['json']		= $user_data['object']->toJson();
		}else{
			if(Session::has('user_data')){
				$user_data['array'] 	= Session::get('user_data');			;
				
				$user_data['object'] 			= new User();
				$user_data['object']->id 	= NULL;
				$user_data['object']->fill($user_data['array']);			
				
				$user_data['json']			= $user_data['object']->toJson(JSON_UNESCAPED_UNICODE);
			}
		}

		return $user_data;
	}

	protected function getProduct($product_id){
		$product_id = (integer) $product_id;

		// Если сразу офорляют товар
		if($product_id){
			$product = Product::find($product_id);
			if($product){
				return $product;
			}else{
				// Если в url указан не существующий товар
				$message = "Не найден товар для оформления покупки. Пожайлуйста, повторите позже";
				return redirect()->back()->with('error' , $message);
			}
		}else{
			return false;
		}
	}

	protected function getCartData(){

		$result['products']	= array();
		$result['carts']	= array();
		$prices				= array();

		if(Auth::check()){
			$user 	= Auth::user();
			$carts 	= Cart::where(['user_id' => $user->id]);

			if($carts){
				$result['header'] 	= 'db';
				$carts = $carts->get();

				if (count($carts)) {
					foreach ($carts as $cart) {
						$product = Cart::find($cart->id)->product;
						array_push($result['products'], $product);
						array_push($result['carts'] , $cart->id);
						array_push($prices, $product->price);
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
						array_push($result['products'], $product);
						array_push($result['carts'] , NULL);
						array_push($prices, $product->price);
					}
				}
			}
		}

		$result['sum'] = array_sum($prices);

		return $result;
	}

}
