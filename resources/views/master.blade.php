<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Web-store</title>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	{!! HTML::style('admin/css/system.css') !!}
</head>
<body>

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	    		<ul class="nav navbar-nav">
			      	<li>
			      		<a class="navbar-brand" href="#">
			        	{!! HTML::image('admin/i/logo/s.jpg' , 'logo' , array('style' => 'height: 30px') ) !!}
			      		</a>
			      	</li>
		        	<!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
		        	<li>{!! link_to_route('categories.index' , 'Категории') !!}</li>
        		</ul>
	    </div>
	  </div>
	</nav>
	
	<div class="container">
		@yield('content')
	</div>

</body>
</html>