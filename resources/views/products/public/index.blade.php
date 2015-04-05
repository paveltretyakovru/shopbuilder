@extends('phones.master')

@section('breadcrumb')
	<div class="secondary"></div>

	<li class="active">Телефоны</li>
@stop

@section('content')
	<br />
	
	<div class="row">
		@foreach ($products as $product)
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="{!! $images[$product->id]->publicurl  !!}" alt="{!! $product->title !!}" style="height:200px">
					<div class="caption">
						<h4>{!! $product->title !!}</h4>
					</div>
				</div>
			</div>
		@endforeach
	</div>

	{{-- 

	@foreach ($products as $product)
		{!! $product->view !!}
	@endforeach

	<script type="text/javascript">
		gridster = $('.gridster > ul').gridster({
        	widget_margins			: [2, 2],
        	widget_base_dimensions	: [25, 25],
        	max_cols				: 25,        	
        	resize	: {enabled: false}
      }).data('gridster').disable();
	</script>

	 --}}
@stop

@section('jsincludes')

@stop