<?php namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
//use Illuminate\Users\Repository as UserRepository;

use Auth;
use Session;

class CartComposer {    

    public function __construct(){
        
    }
    
    public function compose(View $view){
        // переменная, количество товаров в корзине
        $view->with('carts_items', $this->getCartCount());
    }

    /*
        # function getCartCount() - получаем количество товаров, которые добавлены в корзину
        # но не формлены и не подтверждены
    */
    protected function getCartCount(){
        $sessionCount  = $this->getSessionCartCount();

        if ($this->checkAuth()) {
            $user = $this->getUserData();            
                // Пытаемся получить количество не оформленных покупок из базы данных
                return $this->getDBCartCount($user);
        } else {
            return $sessionCount;
        }        
    }

    // Получаем данные пользователя
    protected function getUserData(){
        return Auth::user();
    }

    // Получаем данные неформленных покупок из базы данных
    protected function getDBCartData($user){
        return \App\Cart::where([
            'user_id'   => $user->id ,
            'checkout'  => false
        ])->get();
    }


    // Добавленых товаров пользователем $user в базу данных
    protected function getDBCartCount($user){
        $carts = $this->getDBCartData($user);

        if($carts){
            return $carts->count();
        }else{            
            return 0;
        }
    }

    // Добавленных товаров из сессии
    protected function getSessionCartData(){
        if (Session::has('cart')) {
            return Session::get('cart');
        }else{
            return array();
        }
    }

    // Количество добавленных товаров из сесии
    protected function getSessionCartCount(){
        $data = $this->getSessionCartData();

        return count($data);
    }

    // Авторизован ли пользователь
    protected function checkAuth(){
        if (Auth::check()) {
            return true;            
        } else {
            return false;
        }
        
    }

}