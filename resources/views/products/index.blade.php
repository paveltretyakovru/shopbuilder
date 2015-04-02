@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('/admin' , "Административная панель") !!}</li>
	<li class="active">Продукция</li>
@stop

@section('content')

	<ul class='list-group'>
		@foreach ($products as $product)
			<li class='list-group-item'>
				{!! link_to_route('admin.products.show' , $product->title , [$product->id]) !!}
				{!! link_to_route('admin.products.edit' , 'Редактировать' , [$product->id] , array('class' => 'btn btn-primary btn-xs edit-btn')) !!}
			</li>
		@endforeach
	</ul>

	<hr>
	{!! link_to_route('admin.products.create' , 'Добавить продукт' , array(), array('class' => 'btn btn-success btn-s')) !!}
@stop