@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('admin/products' , 'Продукция') !!}</li>
	<li class="active">Добавление товара</li>
@stop

@section('content')
	{!! Form::open(['route' => 'admin.products.store', 'method' => 'post']) !!}
		@include('products.form')
	{!! Form::close() !!}
@stop