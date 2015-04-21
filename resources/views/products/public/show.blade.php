@extends('phones.master')

@section('breadcrumb')
	
	<li>{!! link_to('phones' , 'Телефоны') !!}</li>
	<li class="active">{{ $product->title }}</li>
@stop

@section('content')
	@include('shop.tradepanel')

	{!! $view !!}

	<script type="text/javascript">
		gridster = $('.gridster > ul').gridster({
        	widget_margins			: [2, 2],
        	widget_base_dimensions	: [25, 25],
        	max_cols				: 25,        	
        	resize	: {enabled: false}
      }).data('gridster').disable();
	</script>

@stop

@section('jsincludes')

@stop