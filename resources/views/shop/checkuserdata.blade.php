@extends('phones.master')

@section('breadcrumb')
	<li class="active">Оформление заказа</li>
@stop

@section('content')
	<h4>Подтверждение контактной информации</h4>

	@if ($product_id)
		{!! Form::model($user['object'] , ['url' => '/order/confirmdata/'.$product_id , 'method' => 'PATCH']) !!}
			@include('shop.user.contactform');
		{!! Form::close() !!}		
	@else
		{!! Form::model($user['object'] , ['url' => '/order/confirmdata' , 'method' => 'PATCH']) !!}
			@include('shop.user.contactform');
		{!! Form::close() !!}	
	@endif


	<!--
	<div>
		<a href="{{ url('order/checkout') }}" class="btn btn-primary btn-xs edit-btn">Оформить заказ</a>
	</div>
	-->

@stop

@section('jsincludes')

@stop
