<div id="edit-categories-form">
	<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
		{!! Form::label('title', 'Название:') !!}
		{!! Form::text('title' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
	</div>

	<div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
		{!! Form::label('url', 'Url:') !!}
		{!! Form::text('url' , null , ['class' => 'form-control']) !!}
		{!! $errors->first('url', '<span class="help-block">:message</span>') !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('parameters', 'Параметры:') !!}
		{!! Form::textarea('parameters' , null , ['class' => 'form-control' , 'style' => 'height: 50px' , 'id' =>'category-edit-parameters']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('searchparameters', 'Параметры для поиска:') !!}
		<div id="parameters-links">
			@if (!empty($parameters))
				@for ($i = 0; $i < count($parameters); $i++)
					&nbsp;<a href="#" class='label label-primary parameter-label'>{{ $parameters[$i] }}</a>
				@endfor
			@endif
		</div>
		{!! Form::textarea('searchparameters' , null , ['class' => 'form-control' , 'style' => 'height: 50px' , 'id' => 'category-edit-searchparameters']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Отправить' , ['class' => 'btn btn-primary']) !!}
	</div>
</div>