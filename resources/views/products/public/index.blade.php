@extends('phones.master')

@section('breadcrumb')
	<div class="secondary"></div>

	<li class="active">Телефоны</li>
@stop

@section('content')
	<br />

	<div class="row">
		@foreach ($products as $product)
			<div class="col-sm-6 col-md-3">
				<div class="thumbnail">
					<img src="{!! $images[$product->id]->publicurl  !!}" alt="{!! $product->title !!}" style="height:290px">
					<div class="caption">						
						<h5><a href="{{$category->url}}/{{$product->id}}">{{$product->title}}</a></h5>		
						{{ $product->price }} руб.
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