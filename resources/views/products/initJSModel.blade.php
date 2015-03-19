<script type="text/javascript">
	AdminApp.initModels.Product = new AdminApp.Models.Product({
		id 			: {{ $product->id 		}} ,
		price 		: {{ $product->price 	}} ,
		title		: "{{ $product->title 	}}",
		count		: {{ $product->count 	}} ,
		category	: {{ $product->category }} ,
		view		: "{{ $product->view	}}" ,
		editview	: "{{ $product->editview}}" ,
		parameters 	: "@include('parameters.list')"
	});

</script>