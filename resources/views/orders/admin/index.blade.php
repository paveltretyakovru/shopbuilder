@extends('admin.master')

@section('cssincludes')
	{!! HTML::style('css/libs/jqGrid/ui.jqgrid.css') !!}
@stop

@section('breadcrumb')
	<li>{!! link_to('/admin' , "Административная панель") !!}</li>	
	<li class="active">Заказы</li>
@stop

@section('content')	

	Заказы сайта

	<table id="jqGrid"></table>
    <div id="jqGridPager"></div>

@stop

@section('jsincludes')
	{!! HTML::script('js/libs/jqGrid/jquery.jqGrid.min.js') !!}
	{!! HTML::script('js/libs/jqGrid/src/i18n/grid.locale-en.js') !!}
	{!! HTML::script('adminpanel/js/system/views/ordersTable.view.js') !!}
@stop