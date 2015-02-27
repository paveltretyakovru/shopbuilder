AdminApp = 
	Views 			: {}
	Collections 	: {}
	Models			: {}
	initViews		: {}
	initModels		: {}
	initCollections : {}

AdminApp.Views.categoryParameters = Backbone.View.extend
	el 				: '#edit-categories-form'
	$elParams		: $ '#category-edit-parameters'
	$elLabels 		: $ '#parameters-links'
	$elSearchParams : $ '#category-edit-searchparameters'
	
	parameters 			: []
	searchParameters 	: []
	
	events 		:
		'keypress #category-edit-parameters' 	: 'enterText'
		'click .parameter-label' 				: 'clickParameterLebel'
	
	enterText 	: (e) ->
		# чистим массив с параметрами для новой выборки
		@parameters = [];
		# после обновления inputa показываем обновляем список параметров
		@updateParameters(@$elParams , @parameters)
		# обнавляем ссылки
		@insertLabels()

	updateParameters : (el  , array) ->
		# разбиваем значение в тектовом поле в массив из параметров
		parameters = el.val().split ','
		# сохраняем параметры в массив
		@addParameter(parameter , array) for parameter in parameters

	addParameter : (parameter , array) ->
		parameter = $.trim parameter

		if array.indexOf(parameter) == -1 and parameter != ''
			array.push parameter
	
	insertLabels : ->
		console.log @parameters
		string = ""

		createLink = (parameter) ->
			" <a href='#' class='label label-primary parameter-label'>" + parameter + "</a> "
		
		# перебираем введеные параметры 
		string += createLink(parameter) for parameter in @parameters
		@$elLabels.html string

	insertSearchParameter : ->


	clickParameterLebel : (e) ->
		e.preventDefault()
		el = $ e.target

		@$elSearchParams.html @$elSearchParams.html() + ',' + el.html()

		@searchParameters = []
		@updateParameters(@$elSearchParams , @searchParameters);
		join_parameters = @searchParameters.join();
		@$elSearchParams.html join_parameters;






		

AdminApp.initViews.categoryParameters = new AdminApp.Views.categoryParameters()