@extends('admin.master')

@section('breadcrumb')
	<li>{!! link_to('admin' , "Административная панель") !!}</li>
	<li>{!! link_to('categories' , 'Категории товаров') !!}</li>
	<li class="active">{{ $category->title }}</li>
@stop

@section('content')

	<div>
		Параметры: <br />
		@for ($i = 0; $i < count($parameters); $i++)
			<span class='btn btn-info btn-xs'>{{ $parameters[$i] }}</span>
		@endfor
	</div>

	<br>

	<div>
		Параметры для поиска: <br />
		@for ($i = 0; $i < count($searchparameters); $i++)
			<span class='btn btn-info btn-xs'>{{ $searchparameters[$i] }}</span>
		@endfor
	</div>

@stop