@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('admin.categories' , 'Категории товаров') !!}</li>
	<li class="active">Создание категории</li>
@stop

@section('content')
	{!! Form::open(['route' => 'admin.categories.store', 'method' => 'post']) !!}
		@include('categories.form')
	{!! Form::close() !!}
@stop

@section('jsincludes')	
	{!! HTML::script('js/system/views/categoryParameters.view.js') !!}
@stop