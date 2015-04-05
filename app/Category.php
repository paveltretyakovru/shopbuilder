<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent {
	protected $table = 'categories';

	protected $fillable = [
		'title' , 'url' , 'parameters' , 'searchparameters'
	];
}
