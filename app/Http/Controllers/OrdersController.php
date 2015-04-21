<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

// not auto include
use Auth;
use Session;
use Validator;
use \App\Product;

/*
	# class OrdersController
	# Обратить внимание на метод - validateUserData!
*/

class OrdersController extends Controller {

	public function getCheckout($product_id = 0){

		// Проверяем прошёл ли пользователь стадию проверки контакнтых данных
		if(Session::has('check_data') && Session::get('check_data')){
			
			$product 	= $this->getProduct($product_id);
			$user 		= $this->getUserData();

			// если идет сразу оформление товара
			if ($product){
				
			// если идет оформление покупки из корзины
			}else{
				
			}

		}else{
			return redirect('/order/checkdata');
		}	
	}

	protected function createOrder(){

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
			'array'		=> []
		];

		if(Auth::check()){
			$user_data['object'] 	= Auth::user();
			$user_data['array']		= $user_data['object']->toArray();
		}else{
			if(Session::has('user_data')){
				$user_data['array'] 	= Session::get('user_data');
				$user_data['object'] 	= (object) $user_data['array'];
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

}
