@extends('master')

@section('content')
	<h1>Создание категории</h1>
	{!! Form::open(['route' => 'categories.store', 'method' => 'post']) !!}
		@include('categories.form')
	{!! Form::close() !!}
@stop