@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('products' , 'Продукция') !!}</li>
	<li>{!! link_to_route('products.show' , $product->title , [$product->id]) !!}</li>
	<li>{!! link_to_route('products.edit' , 'Редактор' , [$product->id]) !!}</li>
	<li class="active">Внешний вид</li>
@stop

@section('content')

	<div id="gridster-system">
	
		<div id="gridster-control-panel">

			<button type="button" class="btn btn-default" id="add-grid-widget">
			  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			</button>

			<button type="button" class="btn btn-default" id="delete-grid-widget" disabled>
			  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</button>

			<button type="button" class="btn btn-default" id="edit-grid-widget" disabled>
			  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
			</button>

		</div>


		<div class="gridster">
		    <ul>
		    	<!--
		        <li data-row="1" data-col="1" data-sizex="1" data-sizey="1"></li>
		        <li data-row="2" data-col="1" data-sizex="1" data-sizey="1"></li>
		        <li data-row="3" data-col="1" data-sizex="1" data-sizey="1"></li>
		 
		        <li data-row="1" data-col="2" data-sizex="2" data-sizey="1"></li>
		        <li data-row="2" data-col="2" data-sizex="2" data-sizey="2"></li>
		 
		        <li data-row="1" data-col="4" data-sizex="1" data-sizey="1"></li>
		        <li data-row="2" data-col="4" data-sizex="2" data-sizey="1"></li>
		        <li data-row="3" data-col="4" data-sizex="1" data-sizey="1"></li>
		 
		        <li data-row="1" data-col="5" data-sizex="1" data-sizey="1"></li>
		        <li data-row="3" data-col="5" data-sizex="1" data-sizey="1"></li>
		    	-->
		    </ul>
		</div>	
	</div>

	<script type="text/template" id=""></script>

@stop