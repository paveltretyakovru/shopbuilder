@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('products.index' , 'Продукты') !!}</li>
	<li class="active">Добавление товара</li>
@stop

@section('content')
	{!! Form::open(['route' => 'products.store', 'method' => 'post']) !!}
		@include('products.form')
	{!! Form::close() !!}
@stop