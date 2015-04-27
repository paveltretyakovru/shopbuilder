@extends('phones.master')

@section('breadcrumb')		
	<li class="active">Корзина</li>
@stop

@section('content')	

	<h4>Количество товароа в корзине: <strong>{{ $carts_items }}</strong> </h4>

	<div class="row">
		
		@if (count($products))
			@foreach ($products as $product)
				<div class="col-sm-6 col-md-3">
					<div class="thumbnail">
						<img src="{!! $images[$product->id]->publicurl  !!}" alt="{!! $product->title !!}" style="height:290px">
						<div class="caption">						
							<h5><a href="#{{-- url( $category->url.'/'.$product->id )--}}">{{$product->title}}</a></h5>		
							<strong>{{ $product->price }}</strong> руб.
							<p><a href="{{ url('deleteCart/'.$product->id) }}">Удалить</a></p>
						</div>
					</div>
				</div>
			@endforeach
		@endif

	</div>

	<div>
		<h2>Итого: <strong>{{ $sum }}</strong> рублей</h2>
	</div>

	<div>
		<a href="{{ url('order/checkdata') }}" class="btn btn-primary btn-xs edit-btn">Оформить заказ</a>
	</div>

@stop

@section('jsincludes')

@stop
