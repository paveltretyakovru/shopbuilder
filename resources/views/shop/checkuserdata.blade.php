@extends('phones.master')

@section('breadcrumb')
	<li class="active">Оформление заказа</li>
@stop

@section('content')
	<h4>Подтверждение контактной информации</h4>
	
	{!! Form::model($user['object'] , ['url' => '/order/confirmdata' , 'method' => 'PATCH']) !!}
		@include('shop.user.contactform');
	{!! Form::close() !!}		


	<!--
	<div>
		<a href="{{ url('order/checkout') }}" class="btn btn-primary btn-xs edit-btn">Оформить заказ</a>
	</div>
	-->

@stop

@section('jsincludes')

@stop
