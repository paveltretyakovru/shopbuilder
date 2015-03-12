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

			<div class="input-group">
				<div class="input-group-btn">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		            	Добавить виджет...
		            	<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu" role="menu" id="add-grid-widget">
						<li><a href="#" data-widget-type="text">с текстом</a></li>
						<li><a href="#" data-widget-type="image">с изображением</a></li>
						<li><a href="#" data-widget-type="parameters">с параметрами товара</a></li>
						<li><a href="#" data-widget-type="title">с названием товара</a></li>
					<!--
					<li class="divider"></li>
					<li><a href="#">Separated link</a></li>
	            	-->
	            	</ul>

					<button type="button" class="btn btn-default" aria-expanded="false" id="delete-grid-widget" disabled="disabled">
						Удалить
					</button>
					<button type="button" class="btn btn-default" aria-expanded="false" id="edit-grid-widget" disabled  data-toggle="modal" data-target="#edit-widget-modal">
	            		Редактировать
					</button>
				</div>
			</div>

		</div>
		
		<div class="gridster">
		    <ul>
		    	
		    </ul>

		    <button id="serialize-grid">Serialize</button>
		</div>

		<div class="modal fade bs-example-modal-lg" id="edit-widget-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Редакатирование виджета</h4>
					</div>
					<div class="modal-body">
						<div id="widget-editor-body">
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="widget-save-changes">Сохранить изменения</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

	</div>

	<script type="text/template" id="product-title-template">
		@include('products.title');
	</script>

	<script type="text/template" id="product-parameters-template">
		@include('parameters.list')
	</script>

	<script type="text/template" id="template-text-editor">
		@include('templates.texteditor')
	</script>

	<script type="text/template" id="template-load-views-image">
		@include('templates.loadviewsimage')
	</script>

@stop