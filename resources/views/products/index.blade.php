@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li class="active">Продукты</li>
@stop

@section('content')

	<ul class='list-group'>
	
	</ul>

	<hr>
	{!! link_to_route('products.create' , 'Добавить продукт' , array(), array('class' => 'btn btn-success btn-s')) !!}
@stop