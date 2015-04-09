@extends('phones.master')

@section('breadcrumb')
	<div class="secondary"></div>
	
	<li>{!! link_to('phones' , 'Телефоны') !!}</li>
	<li class="active">{{ $product->title }}</li>
@stop

@section('content')
	<br />

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