@foreach ($parameters as $parameter)
	<p>
		{{ str_replace('_', ' ' , $parameter->title)  }} : <strong>{{ $parameter->value }}</strong>
	</p>

@endforeach