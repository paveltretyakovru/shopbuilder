<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Category $category)
	{
		$categories = $category->get();
		return view('categories.index' , compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CategoryFormRequest $request , Category $category)
	{
		$category->create($request->all());
		return redirect()->route('categories.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Category $category)
	{
		$get_prams 			= $this->getParameters($category);
		$parameters 		= $get_prams[0];
		$searchparameters 	= $get_prams[1];

		return view('categories.show' , compact('category' , 'parameters' , 'searchparameters'));
	}

	private function getParameters($category){
		$parameters = array();

		if(strpos($category->parameters, ',')){
			$parameters[0] 	= explode(',', $category->parameters);
		}else{
			$parameters[0] 	= array();
			$parameters[0][]= $category->parameters;
		}

		if(strpos($category->searchparameters, ',')){
			$parameters[1]		= explode(',', $category->searchparameters);
		}else{
			$parameters[1] 	 = array();
			$parameters[1][] = $category->searchparameters;
		}

		return $parameters;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Category $category)
	{
		if(strpos($category->parameters, ',')){
			$parameters 	= explode(',', $category->parameters);
		}else{
			$parameters 	= array();
			$parameters[] = $category->parameters;
		}

		return view('categories.edit' , compact('category' , 'parameters'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($category , Request $req)
	{
		$category->fill($req->input())->save();
		return redirect('categories');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Category $category)
	{
		$category->delete();
		return redirect('categories');
	}

}
