@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('admin/categories' , 'Категории товаров') !!}</li>
	<li class="active">Редактирование категории {{ $category->title }}</li>
@stop

@section('content')
	{!! Form::model($category , ['route' => 'admin.categories.update' , 'method' => 'POST']) !!}

		@include('categories.form' , ['parameters' => $parameters])

	{!! Form::close() !!}

	{!! delete_form(['admin.categories.destroy' , $category->id]) !!}
@stop

@section('jsincludes')	
	{!! HTML::script('admin/js/system/views/categoryParameters.view.js') !!}
@stop