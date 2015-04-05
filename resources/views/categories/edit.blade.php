@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('admin/categories' , 'Категории товаров') !!}</li>
	<li class="active">Редактирование категории {{ $category->title }}</li>
@stop

@section('content')	
	@if (Session::has('success'))
		<div class="alert alert-success" role="alert">{{ session('success') }}</div>
	@endif

	@if (Session::has('error'))
		<div class="alert alert-danger" role="alert">{{ session('error') }}</div>
	@endif

	{!! Form::model($category , ['route' => ['admin.categories.update' , $category->id] , 'method' => 'PATCH']) !!}

		@include('categories.form' , ['parameters' => $parameters])

	{!! Form::close() !!}

	{!! delete_form(['admin.categories.destroy' , $category->id]) !!}
@stop

@section('jsincludes')	
	{!! HTML::script('adminpanel/js/system/views/categoryParameters.view.js') !!}
@stop