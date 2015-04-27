<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//Not auto includes
use Auth;
use App\Order;
use App\SiteFiles;

class UsersController extends Controller {

	public function getContactinfo(){		
		if(Auth::check()){
			$user = Auth::user();
			return view('shop.user.changecontact' , compact('user'));
		}else{
			return redirect('auth/login')->with('info' , 'Для входа в личный кабинет, необходимо авторизоваться');
		}
	}

	public function patchUpdate(Requests\UserDataRequest $req){
		if(Auth::check()){
			$user = Auth::user();
			$user->fill($req->input())->save();
			return redirect()->back()->with('success' , 'Данные успешно сохранены');
		}else{
			return redirect('auth/login')->with('info' , 'Для входа в личный кабинет, необходимо авторизоваться');
		}
	}

	public function getOrders(){
		if(Auth::check()){
			// Модель пользователя
			$user = Auth::user();
			// Изображения заказынных товаров...
			$images 	= [];

			$orders = Order::where([
				'user_id' => $user->id
			]);

			if($orders){
				// Модели заказов пользователя
				$orders 	= $orders->get();
				// Получаем изображения товаров
				foreach ($orders as $order) {					
					$images[$order->product->id] = $this->getFirstProductImage($order->product->id);					
				}				

			}else{
				$orders = [];
			}

			return view('shop.user.getorders' , compact('user' , 'orders' , 'images'));
		}else{
			return redirect('auth/login')->with('info' , 'Для входа в личный кабинет, необходимо авторизоваться');
		}
	}

	protected function getFirstProductImage($product_id){	

		$images = SiteFiles::where([
			'type' 		=> 'image' ,
			'group'		=> 'products' ,
			'groupid'	=> $product_id
		]);

		if($images){
			$images = $images->get();
			return $images[0];
		}
	}

}
