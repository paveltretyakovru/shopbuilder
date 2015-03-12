<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;
use App\Product;

class ProductsController extends Controller {

	public function index(Product $product)
	{
		$products = $product->get();
		return view('products.index' , compact('products'));
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

	public function store(Requests\ProductFormRequest $request , Product $product)
	{
		$product->create($request->all());
		return redirect()->route('products.index');
	}

	public function show(Product $product)
	{
		return view('products.show' , compact('product'));
	}

	public function edit(Product $product)
	{
		$categorieslist = array();
		$categories = $this->getCategoriesTitlesList();

		for ($i=0; $i < count($categories); $i++) { 
			$categorieslist[$categories[$i]['id']] = $categories[$i]['title'];
		}

		return view('products.edit' , compact('categorieslist' , 'product'));
	}
	
	public function update(Request $request){

		if ($request->format() == 'json') {
			$product = Product::where(['id' => $request->id])->firstOrFail();

			$product->price 	= $request->price;
			$product->title 	= $request->title;
			$product->count 	= $request->count;
			$product->category 	= $request->category;
			$product->view 		= $request->view;
			$product->save();		
		}
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
