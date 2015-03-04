@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('products' , 'Продукция') !!}</li>
	<li>{!! link_to_route('products.show' , $product->title , [$product->id]) !!}</li>
	<li>{!! link_to_route('products.edit' , 'Редактор' , [$product->id]) !!}</li>
	<li class="active">Параметры</li>
@stop

@section('content')

	{!! Form::open( [ 'route' => ['parameters.update' , $product->id] , 'method' => 'POST'] ) !!}
		<ul class='list-group input-list'>
			
			@for ($i = 0; $i < count($parameters); $i++)
				<li class='list-group-item'>
					@if (array_key_exists(str_replace(' ', '_' , $parameters[$i]),$issetparameters))
						{{ $parameters[$i] }} {!! FORM::text($parameters[$i] , $issetparameters[str_replace(' ', '_' , $parameters[$i])]) !!}
					@else
						{{ $parameters[$i] }} {!! FORM::text($parameters[$i]) !!}
					@endif

					
				</li>
			@endfor
		
		</ul>

		{!! Form::submit('Сохранить' , array('class' => 'btn btn-primary')); !!}	
	{!! Form::close() !!}

@stop