@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('products' , 'Продукция') !!}</li>
	<li>{!! link_to_route('products.edit' , $product->title , [$product->id]) !!}</li>
	<li class="active">Параметры</li>
@stop

@section('content')

	{!! Form::open( [ 'route' => ['parameters.update' , $product->id] , 'method' => 'POST'] ) !!}
		<ul class='list-group input-list'>
			
			@for ($i = 0; $i < count($parameters); $i++)
				<li class='list-group-item'>
					@if (!empty($issetparameters[str_replace(' ', '_' , $parameters[$i])]))
						{{ $parameters[$i] }} {!! FORM::text($parameters[$i] , $issetparameters[str_replace(' ', '_' , $parameters[$i])]) !!}
					@else
						{{ $parameters[$i] }} {!! FORM::text($parameters[$i] , $issetparameters[str_replace(' ', '_' , $parameters[$i])]) !!}
					@endif

					
				</li>
			@endfor
		
		</ul>

		{!! Form::submit('Сохранить' , array('class' => 'btn btn-primary')); !!}	
	{!! Form::close() !!}

@stop