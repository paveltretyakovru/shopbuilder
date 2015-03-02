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

	initialize : ->
		console.log 'Initialize categoryParameters viw'

		# создание метки добавления параметров для поиска
		insertLabel = (tagname) =>
			console.log 'insertLabel'
			label =	"<a href='#' class='label label-primary parameter-label'>" + tagname + "</a> "		
			@$elLabels.append label

		# при удалении тега в параметрах, удаляем этот тег везде
		deleteLabel = (tagname) =>
			@$elLabels.find('a:contains(' + tagname + ')').remove();
			@$elSearchParams.removeTag tagname

		# предотвращаем добавления поискового тега которого нет в параметрах
		addSearchTag = (tagname) =>
			@$elSearchParams.removeTag tagname if not @$elParams.tagExist tagname

		# активируем плагин тегов у параметров
		@$elParams.tagsInput
			'width' 		: '100%'
			'defaultText' 	: 'добавить параметр'
			'onAddTag'		: (tagname) ->
				insertLabel tagname
			'onRemoveTag'	: (tagname) ->
				deleteLabel tagname
		
		# активируем плагин тегов у параметров для поиска
		@$elSearchParams.tagsInput
			'width' 		: '100%'
			'defaultText' 	: ''
			'onAddTag'		: (tagname) ->
				addSearchTag tagname
	
	# EVENTS
	events 		:
		'keypress #category-edit-parameters' 	: 'enterText'
		'click .parameter-label' 				: 'clickParameterLebel'

	insertSearchParameter : ->

	# клик по меткам добавляет тег у параметров для поиска
	clickParameterLebel : (e) ->
		e.preventDefault()
		el 	= $ e.target
		tag = el.html()

		if not @$elSearchParams.tagExist tag
			@$elSearchParams.addTag tag
		else console.log 'Параметр уже существует'






		

AdminApp.initViews.categoryParameters = new AdminApp.Views.categoryParameters()