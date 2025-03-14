<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Category;
use App\Product;

class ProductsController extends Controller {

	public function index(Product $product)
	{
		$products = $product->get();
		return view('products.admin.index' , compact('products'));
	}

	public function create()
	{
		$categorieslist = [];
		$categories = $this->getCategoriesTitlesList();

		for ($i=0; $i < count($categories); $i++) { 
			$categorieslist[$categories[$i]['id']] = $categories[$i]['title'];
		}

		return view('products.admin.create' , compact('categorieslist'));
	}

	public function store(Requests\ProductFormRequest $request , Product $product)
	{
		$product->create($request->all());
		return redirect()->route('admin.products.index');
	}

	public function show(Product $product)
	{
		return view('products.admin.show' , compact('product'));
	}

	public function edit(Product $product)
	{
		$categorieslist = [];
		$categories = $this->getCategoriesTitlesList();

		for ($i=0; $i < count($categories); $i++) { 
			$categorieslist[$categories[$i]['id']] = $categories[$i]['title'];
		}

		return view('products.admin.edit' , compact('categorieslist' , 'product'));
	}
	
	public function update($product , Request $request){

		$product->price 	= ($request->has('price')) 		? $request->price : $product->price;
		$product->title 	= ($request->has('title')) 		? $request->title : $product->title;
		$product->count 	= ($request->has('count')) 		? $request->count : $product->count;;
		$product->category 	= ($request->has('category')) 	? $request->category : $product->category;
		$product->view 		= ($request->has('view')) 		? $request->view : $product->view;
		$product->editview	= ($request->has('editview')) 	? $request->editview : $product->editview;
		$result = $product->save();

		// Если передано ajax-ом
		if ($request->format() == 'json') {
			if ($result) {
				return response()->json(['success' , 'message' => 'Изменения сохранены!']);
			}else{
				return response()->json(['error' , 'error' => 'Возникла ошибка при обновлении данных']);
			}
		}else{
			if ($result) {
				return redirect()->back()->with('success' , 'Изменения сохранены!');
			}else{
				return redirect()->back()->with('error' , 'Возникла ошибка при обновлении данных');
			}
		}
	}
	
	public function destroy($id)
	{
		return 'Products destroy';
	}

	public function getCategoriesTitlesList(){
		$result = [];
		$categories = Category::all();

		for ($i=0; $i < count($categories); $i++) { 
			$result[] = [
				'id'	=> $categories[$i]->id ,
				'title' => $categories[$i]->title
			];
		}

		return $result;
	}

}
