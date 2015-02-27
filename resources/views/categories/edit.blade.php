@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('categories' , 'Категории товаров') !!}</li>
	<li class="active">Редактирование категории</li>
@stop

@section('content')
	{!! Form::model($category , ['route' => ['categories.update' , $category->id] , 'method' => 'PATCH']) !!}

		@include('categories.form')

	{!! Form::close() !!}

	{!! delete_form(['categories.destroy' , $category->id]) !!}
@stop