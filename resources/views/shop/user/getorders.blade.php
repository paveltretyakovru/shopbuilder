@extends('phones.master')

@section('breadcrumb')	
	<li class="active">Изменение контактных данных</li>
@stop

@section('content')

	<ul class="nav nav-tabs" role="tablist" id="cabinet_menu">
  		<li role="presentation"><a href="{{ url('user/contactinfo') }}">Контакнтные данные</a></li>
  		<li role="presentation" class="active"><a href="#">Заказы</a></li>
	</ul>

	<br />
	
	@if (count($orders))
		

	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">История заказов</div>

		<!-- Table -->
		<table class="table">
			<thead>
				<tr>
				<th></th>
				<th>Наименование</th>
				<th>Цена</th>
				<th>Статус</th>
				<th>Дата оформления</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orders as $order)
					@if ($order->status == "checkout")
						<?php $status = "Оформлен" ?>
					@elseif ($order->status == "confirmed")
						<?php $status = "Подтвержден" ?>
					@elseif ($order->status == "paid")
						<?php $status = "Оплачен" ?>
					@endif					

					<tr>
						<td width="100"><img src="{{ $images[$order->product_id]->publicurl }}"/></td>
						<td>{{ $order->product->title }}</td>
						<td>{{ $order->product->price }} рублей</td>
						<td>{{ $status }}</td>
						<td>{{ $order->created_at }}</td>
					</tr>
				@endforeach

			</tbody>
		</table>
	</div>

	@else
		Вы еще не совершали никаких покупок
	@endif

@stop

@section('jsincludes')

@stop
