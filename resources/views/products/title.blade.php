{{-- Вывести заголовок, либо шаблон для backbone --}}
@if (!isset($underscore))	
	<div class="product-title">
		{{ $product->title }}
	</div>
@else
	{{-- Underscore шаблон. Для использования в backbone --}}
	<script type="text/template" id="underscore-product-title-template"><div class="product-title"><%= title %></div>
	</script>
@endif
