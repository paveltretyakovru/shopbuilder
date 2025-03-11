<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	protected $table = 'orders';

	protected $fillabla = [
		'status' , 'phone'
	];

	public function product(){
		return $this->belongsTo(\App\Product::class);
	}

	public function user(){
		return $this->belongsTo(\App\User::class);
	}

}
