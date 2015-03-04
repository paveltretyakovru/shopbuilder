@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('categories' , 'Категории товаров') !!}</li>
	<li class="active">Редактирование категории {{ $category->title }}</li>
@stop

@section('content')
	{!! Form::model($category , ['route' => 'categories.update' , 'method' => 'POST']) !!}

		@include('categories.form' , ['parameters' => $parameters])

	{!! Form::close() !!}

	{!! delete_form(['categories.destroy' , $category->id]) !!}
@stop