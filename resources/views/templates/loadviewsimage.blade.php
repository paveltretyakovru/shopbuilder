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
<div id="progress-load-image"></div>
<br>
<div id="result-load-image"></div>