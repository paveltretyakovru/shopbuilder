AdminApp = 
	Views 			: {}
	Collections 	: {}
	Models			: {}
	initViews		: {}
	initModels		: {}
	initCollections : {}

AdminApp.Views.categoryParameters = Backbone.View.extend
	el 			: '#edit-categories-form'
	$elParams	: $ '#category-edit-parameters'
	$elLabels 	: $ '#parameters-links'
	
	parameters 	: []
	
	events 		:
		'keypress #category-edit-parameters' : 'enterText'
	
	enterText 	: (e) ->
		# чистим параметры
		@parameters = []
		# разбиваем значение в тектовом поле в массив из параметров
		parameters 	= @$elParams.val().split ','
		# сохраняем параметры в массив
		@addParameter(parameter) for parameter in parameters
		# обнавляем ссылки
		@insertLabels()

	addParameter : (parameter) ->
		parameter = $.trim parameter
		if @parameters.indexOf(parameter) == -1 and parameter != ''
			@parameters.push parameter
	
	insertLabels : ->
		string = ""

		createLink = (parameter) ->
			" <a href='#' class='label label-primary'>" + parameter + "</a> "
		
		# перебираем введеные параметры 
		string += createLink(parameter) for parameter in @parameters
		@$elLabels.html string
		

AdminApp.initViews.categoryParameters = new AdminApp.Views.categoryParameters()