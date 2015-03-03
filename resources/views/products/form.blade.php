<div id="edit-products-form">

	{{-- TITLE --}}
	<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
		{!! Form::label('title', 'Название:') !!}
		{!! Form::text('title' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
	</div>

	{{-- CATEGORY --}}
	<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
		{!! Form::label('category', 'Категория:') !!}
		{!! Form::select('category', $categorieslist); !!}
		{!! $errors->first('category', '<span class="help-block">:message</span>') !!}
	</div>

	{{-- PRICE --}}
	<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
		{!! Form::label('price', 'Цена:') !!}
		{!! Form::text('price' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('price', '<span class="help-block">:message</span>') !!}
	</div>

	{{-- COUNT --}}
	<div class="form-group {{ $errors->has('count') ? 'has-error' : '' }}">
		{!! Form::label('count', 'Количество:') !!}
		{!! Form::text('count' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('count', '<span class="help-block">:message</span>') !!}
	</div>

	{{-- VISIBLE --}}
	<div class="form-group {{ $errors->has('visible') ? 'has-error' : '' }}">
		{!! Form::label('visible', 'Видимый:') !!}
		{!! Form::checkbox('visible' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('visible', '<span class="help-block">:message</span>') !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Отправить' , ['class' => 'btn btn-primary']) !!}
	</div>
</div>