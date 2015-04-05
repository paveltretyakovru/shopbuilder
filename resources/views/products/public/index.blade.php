@extends('phones.master')

@section('content')
	<div class="secondary"></div>
	@foreach ($products as $product)
		{!! $product->view !!}
	@endforeach

	<script type="text/javascript">
		gridster = $('.gridster > ul').gridster({
        	widget_margins			: [2, 2],
        	widget_base_dimensions	: [25, 25],
        	autogrow_cols			: true,
        	max_cols				: 25,
        	
        	resize	: {
          		enabled: true
        	}       	
      }).data('gridster').disable();
	</script>
@stop