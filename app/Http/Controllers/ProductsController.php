<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;

class ProductsController extends Controller {

	public function index()
	{
		return view('products.index');
	}

	public function create()
	{
		$categorieslist = array();
		$categories = $this->getCategoriesTitlesList();

		for ($i=0; $i < count($categories); $i++) { 
			$categorieslist[$categories[$i]['id']] = $categories[$i]['title'];
		}

		return view('products.create' , compact('categorieslist'));
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

	public function getCategoriesTitlesList(){
		$result = array();
		$categories = Category::all();

		for ($i=0; $i < count($categories); $i++) { 
			$result[] = array(
				'id'	=> $categories[$i]->id ,
				'title' => $categories[$i]->title
			);
		}

		return $result;
	}

}
