<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Telefonus - быстрый способ найти свой телефон</title>

	<link rel="shortcut icon" href="phones/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	{!! HTML::style('templates/phones/css/bootstrap.min.css') !!}
	{!! HTML::style('templates/phones/css/font-awesome.min.css') !!}

	<!-- Custom styles for our template -->
	{!! HTML::style('templates/phones/css/bootstrap-theme.css') !!}
	{!! HTML::style('templates/phones/css/main.css') !!}

	

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		{!! HTML::style('templates/phones/js/html5shiv.js') !!}
		{!! HTML::style('templates/phones/js/respond.min.js') !!}
	<![endif]-->
	{!! HTML::style('adminpanel/css/libs/jquery-ui.css') !!}
	{!! HTML::style('adminpanel/css/libs/jquery.gridster.css') !!}	

	{!! HTML::script('js/libs/jquery.min.js') !!}
	{!! HTML::script('js/libs/jquery.gridster.min.js') !!}
</head>

<body class="home">

	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="templates/phones/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="#">Телефоны</a></li>
					<li><a href="#">О нас</a></li>
					{{--
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">More Pages <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="sidebar-left.html">Left Sidebar</a></li>
							<li class="active"><a href="sidebar-right.html">Right Sidebar</a></li>
						</ul>
					</li>
					 --}}
					<li><a href="#">Контакты</a></li>
					<li><a class="btn" href="#">Вход / Регистрация</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<div class="container">
	
		@yield('breadcrumb')
		@yield('content')

	</div>	

	@include('phones.footer')

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

	{!! HTML::script('js/libs/underscore-min.js') !!}
	{!! HTML::script('js/libs/backbone-min.js') !!}	

	{!! HTML::script('templates/phones/js/headroom.min.js') !!}
	{!! HTML::script('templates/phones/js/jQuery.headroom.min.js') !!}
	{!! HTML::script('templates/phones/js/template.js') !!}

	@yield('jsincludes')

</body>
</html>