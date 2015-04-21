<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//Not auto includes
use Auth;

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

}
