@extends('master')

@section('content')
	<h1>Редактирование категории: {{ $category->title }}</h1>
	{!! Form::model($category , ['route' => ['categories.update' , $category->id] , 'method' => 'PATCH']) !!}

		@include('categories.form')

	{!! Form::close() !!}

	{!! delete_form(['categories.destroy' , $category->id]) !!}
@stop