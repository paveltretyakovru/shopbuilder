@extends('phones.master')

@section('breadcrumb')
	<div class="secondary"></div>	
	<li class="active">Оформление заказа</li>
@stop

@section('content')
	<h4>Количество товароа в корзине: <strong>{{ $carts_items }}</strong> </h4>	

	<div>
		<h2>Итого: <strong>{{ $sum }}</strong> реблей</h2>
	</div>

	<!--
	<div>
		<a href="{{ url('order/checkout') }}" class="btn btn-primary btn-xs edit-btn">Оформить заказ</a>
	</div>
	-->

@stop

@section('jsincludes')

@stop
