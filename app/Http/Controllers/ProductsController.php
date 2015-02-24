<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductsController extends Controller {

	public function index()
	{
		return 'Products index';
	}

	public function create()
	{
		return 'Products create';
	}

	public function store()
	{
		return 'Products store';
	}

	public function show($id)
	{
		return 'Products show';
	}

	public function edit($id)
	{
		return 'Products edit';
	}
	
	public function update($id)
	{
		return 'Products update';
	}
	
	public function destroy($id)
	{
		return 'Products destroy';
	}

}
