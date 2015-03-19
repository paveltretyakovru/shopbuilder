<script type="text/javascript">
	AdminApp.initModels.Product = new AdminApp.Models.Product({
		id 			: {{ $product->id 		}} ,
		price 		: {{ $product->price 	}} ,
		title		: "{{ $product->title 	}}",
		count		: {{ $product->count 	}} ,
		category	: {{ $product->category }} ,
		view		: "{{ str_replace(array("\r\n", "\r", "\n"), '', $product->view) }}" ,
		editview	: "{{ $product->editview}}" ,
		parameters 	: "@include('parameters.list')"
	});

</script>