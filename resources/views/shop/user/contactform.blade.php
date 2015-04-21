<div id="edit-products-form">

	{{-- FULLNAME --}}
	<div class="form-group {{ $errors->has('fullname') ? 'has-error' : '' }}">
		{!! Form::label('fullname', 'Полное имя:') !!}
		{!! Form::text('fullname' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('fullname', '<span class="help-block">:message</span>') !!}
	</div>	

	{{-- PHONE --}}
	<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
		{!! Form::label('phone', 'Контактный номер телефона:') !!}
		{!! Form::text('phone' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
	</div>	

	{{-- COUNTRY --}}
	<div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
		{!! Form::label('country', 'Страна:') !!}
		{!! Form::text('country' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('country', '<span class="help-block">:message</span>') !!}
	</div>

	{{-- CITY --}}
	<div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
		{!! Form::label('city', 'Город:') !!}
		{!! Form::text('city' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('city', '<span class="help-block">:message</span>') !!}
	</div>

	{{-- POSTCODE --}}
	<div class="form-group {{ $errors->has('postcode') ? 'has-error' : '' }}">
		{!! Form::label('postcode', 'Почтовый индекс:') !!}
		{!! Form::text('postcode' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('postcode', '<span class="help-block">:message</span>') !!}
	</div>

	{{-- ADDRESS --}}
	<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
		{!! Form::label('address', 'Адрес:') !!}
		{!! Form::textarea('address' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('address', '<span class="help-block">:message</span>') !!}
	</div>	

	<div class="form-group">
		{!! Form::submit('Сохранить' , ['class' => 'btn btn-primary']) !!}
	</div>
</div>