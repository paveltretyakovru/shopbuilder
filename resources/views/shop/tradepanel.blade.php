<div class="tradepanel">
	Цена: <strong>{{ $product->price }}</strong> рублей
	<div>

		@if ($product_in_cart)
			<a href="#" class="btn btn-primary btn-xs edit-btn">Товар в корзине</a>
		@else
			<a href="{{ url('/addProduct/'.$product->id) }}" class="btn btn-primary btn-xs edit-btn">В корзину</a>
			<a href="{{ url('/order/checkdata/'.$product->id) }}" class="btn btn-primary btn-xs edit-btn">Купить</a>
		@endif

	</div>
</div>