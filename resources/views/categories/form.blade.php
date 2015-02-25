		<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
			{!! Form::label('title', 'Название:') !!}
			{!! Form::text('title' , null , ['class' => 'form-control']) !!}
			{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
		</div>

		<div class="form-group">
			{!! Form::label('parameters', 'Параметры:') !!}
			{!! Form::textarea('parameters' , null , ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('searchparameters', 'Параметры для поиска:') !!}
			{!! Form::textarea('searchparameters' , null , ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Отправить' , ['class' => 'btn btn-primary']) !!}
		</div>