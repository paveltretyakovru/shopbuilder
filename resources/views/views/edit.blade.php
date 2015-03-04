@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('products' , 'Продукция') !!}</li>
	<li>{!! link_to_route('products.show' , $product->title , [$product->id]) !!}</li>
	<li>{!! link_to_route('products.edit' , 'Редактор' , [$product->id]) !!}</li>
	<li class="active">Внешний вид</li>
@stop

@section('content')

	Content

@stop