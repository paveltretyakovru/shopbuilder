@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('admin/products' , 'Продукция') !!}</li>
	<li>{!! link_to_route('admin.products.show' , $product->title , [$product->id]) !!}</li>
	<li class="active">Редактор</li>
@stop

@section('content')
	
	<hr>
	{!! link_to_route('admin.parameters.edit' , 'Параметры' , [$product->id] , array('class' => 'btn btn-default')) !!}

	{!! link_to_route('admin.views.edit' , 'Внешний вид' , [$product->id] , array('class' => 'btn btn-default')) !!}
	<hr>

	{!! Form::model($product , ['route' => ['admin.products.update' , $product->id] , 'method' => 'PATCH']) !!}
		@include('products.form')
	{!! Form::close() !!}

	{!! delete_form(['admin.products.destroy' , $product->id]) !!}
@stop