<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TestsController extends Controller {

	public function test(){
		return 'test function';
	}

}
