{!! Form::open(array('action' => 'FilesController@getImageFile', 'files' => true)) !!}
	<div class="form-group">
	{!! Form::label('image', 'Выберите изображение:') !!}
	{!! Form::file('image') !!}
	{!! Form::hidden('group' , 'products') !!}
	{!! Form::hidden('id' , $product->id) !!}
	{!! Form::hidden('title' , $product->title) !!}
	</div>

	{!! Form::submit('Загрузить', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
<br>
<div id="status-load-image"></div>
<div id="progress-load-image">
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
		<span class="sr-only">0% Загружено</span>
	</div>
	</div>
</div>
<br>
<div id="result-load-image"></div>