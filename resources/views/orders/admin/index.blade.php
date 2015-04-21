@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('/admin' , "Административная панель") !!}</li>	
	<li class="active">Заказы</li>
@stop

@section('content')

	Заказы сайта

@stop

@section('jsincludes')
	
@stop