@if (!isset($underscore))
@foreach ($parameters as $parameter) <p>{{ str_replace('_', ' ' , $parameter->title)  }} : <strong>{{ $parameter->value }}</strong></p>@endforeach
@else
	<script type="text/template" id="underscore-product-parameters-template"><%= parameters %></script>
@endif