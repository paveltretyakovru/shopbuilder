@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('products' , 'Продукция') !!}</li>
	<li class="active">Редактирование товара {{ $product->title }}</li>
@stop

@section('content')
	
	<hr>
	{!! link_to_route('parameters.edit' , 'Параметры' , [$product->id] , array('class' => 'btn btn-default')) !!}

	{!! link_to_route('products.edit' , 'Внешний вид' , [$product->id] , array('class' => 'btn btn-default')) !!}
	<hr>

	{!! Form::model($product , ['route' => ['products.update' , $product->id] , 'method' => 'PATCH']) !!}
		@include('products.form')
	{!! Form::close() !!}

	{!! delete_form(['products.destroy' , $product->id]) !!}
@stop