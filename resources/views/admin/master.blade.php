<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Web-store</title>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	{!! HTML::style('css/system.css') !!}
	{!! HTML::style('css/libs/jquery.tagsinput.css') !!}
	{!! HTML::style('css/libs/jquery.gridster.css') !!}
</head>
<body>

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	    		<ul class="nav navbar-nav">
			      	<li>
			      		<a class="navbar-brand" href="admin">
			        	{!! HTML::image('i/logo/s.jpg' , 'logo' , array('style' => 'height: 30px') ) !!}
			      		</a>
			      	</li>
		        	<!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
		        	<li>{!! link_to_route('categories.index' , 'Категории') !!}</li>
		        	<li>{!! link_to_route('products.index' , 'Продукция') !!}</li>
        		</ul>
	    </div>
	  </div>
	</nav>
	

	<div class="container">
		<ol class="breadcrumb">
			@yield('breadcrumb')
		</ol>

		@yield('content')
	</div>

	{!! HTML::script('js/libs/jquery.min.js') !!}
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js'></script>
	
	{!! HTML::script('js/libs/underscore-min.js') !!}
	{!! HTML::script('js/libs/backbone-min.js') !!}
	
	{!! HTML::script('js/libs/jquery.tagsinput.js') !!}
	{!! HTML::script('js/libs/jquery.gridster.min.js') !!}

	{!! HTML::script('js/system/system.js') !!}

</body>
</html>