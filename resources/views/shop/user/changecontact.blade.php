@extends('phones.master')

@section('breadcrumb')	
	<li class="active">Изменение контактных данных</li>
@stop

@section('content')
	
	<h4>Контакнтные данные:</h4>

	{!! Form::model($user , ['url' => '/user/update' , 'method' => 'PATCH']) !!}
		@include('shop.user.contactform');
	{!! Form::close() !!}

@stop

@section('jsincludes')

@stop
