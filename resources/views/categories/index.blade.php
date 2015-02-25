@extends('master')

@section('content')
	<h1>Категории товаров</h1>

	@foreach ($categories as $category)
		<li>
			{!! link_to_route('categories.show' , $category->title , [$category->id]) !!} |
			{!! link_to_route('categories.edit' , 'Редактировать' , [$category->id]) !!}
		</li>
	@endforeach
	<hr>
	{!! link_to_route('categories.create' , 'Новая категория') !!}
@stop