@extends('phones.master')

@section('breadcrumb')	
	<li class="active">Изменение контактных данных</li>
@stop

@section('content')

	<ul class="nav nav-tabs" role="tablist" id="cabinet_menu">
  		<li role="presentation" class="active"><a href="#contactinfo" aria-controls="contactinfo" data-toggle="tab">Контакнтные данные</a></li>
  		<li role="presentation"><a href="{{ url('/user/orders') }}">Заказы</a></li>
	</ul>		

	<br />

	{!! Form::model($user , ['url' => '/user/update' , 'method' => 'PATCH']) !!}
		@include('shop.user.contactform')
	{!! Form::close() !!}


@stop

@section('jsincludes')

@stop
