@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('admin/products' , 'Продукция') !!}</li>
	<li class="active">{{ $product->title }}</li>
@stop

@section('content')

	<ul class='list-group'>
		<li class='list-group-item'>Наименование: <span class='params-value'>{{ $product->title }}</span> </li>
		
		<li class='list-group-item'>Цена: <span class='params-value'>{{ $product->price }}</span> </li>
		
		<li class='list-group-item'>Количество: <span class='params-value'>{{ $product->count }}</span> </li>
		
		<li class='list-group-item'>
			Видимый: <span class='params-value'>{{ ($product->visible == 'on') ? 'Да' : 'Нет' }}</span>
		</li>
	</ul>

	<hr>

	{!! link_to_route('admin.products.edit' , 'Редактировать' , [$product->id] , array('class' => 'btn btn-primary')) !!}

@stop