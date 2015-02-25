@extends('master')

@section('content')
	<h1>Категории товаров</h1>

	<h2>{{ $category->title }}</h2>

	<div>
		Параметры: <br />
		{{ $category->parameters }}
	</div>

	<div>
		Параметры для поиска: <br />
		{{ $category->searchparameters }}
	</div>

	<hr>
	{!! link_to_route('categories.index' , 'Назад к категориям') !!}
@stop