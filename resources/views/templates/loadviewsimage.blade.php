{!! Form::open(array('url' => 'foo/bar', 'files' => true)) !!}
	<div class="form-group">
	{!! Form::label('image', 'Выберите изображение:') !!}
	{!! Form::file('image') !!}
	{!! Form::hidden('group' , 'product') !!}
	{!! Form::hidden('id' , $product->id) !!}
	{!! Form::hidden('title' , $product->title) !!}
	</div>
	{!! Form::submit('Загрузить', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}