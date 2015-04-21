<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

	protected $table = "carts";

	protected $fillable = [
		'product_id' , 'user_id'
	];

	// отношение 1 к 1
	public function product(){
		return $this->belongsTo('App\Product');
	}
}
