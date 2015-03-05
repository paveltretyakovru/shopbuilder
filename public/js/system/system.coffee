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

	initialize : ->
		console.log 'Initialize categoryParameters view'

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
		'click .parameter-label' : 'clickParameterLebel'

	# клик по меткам добавляет тег у параметров для поиска
	clickParameterLebel : (e) ->
		e.preventDefault()
		el 	= $ e.target
		tag = el.html()

		if not @$elSearchParams.tagExist tag
			@$elSearchParams.addTag tag
		else console.log 'Параметр уже существует'


AdminApp.Views.viewsGridSystem = Backbone.View.extend
	el 				: '#gridster-system'	
	$gridster		: {}
	$selectedWiget 	: null
	$deleteWidget	: $ '#delete-grid-widget'
	$editWidget		: $ '#edit-grid-widget'

	initialize 	: ->
		console.log 'Inititalize viewsGridSystem'
		@$gridster = $('.gridster > ul').gridster
			widget_margins			: [2, 2]
			widget_base_dimensions	: [140, 140]
			autogrow_cols			: true
			max_cols				: 5
			resize : 
				enabled : true
		.data 'gridster'

	events 		:
		'click #add-grid-widget'	: 'addWidget'
		'click .gs-w'				: 'clickWidget'
		'click document'			: 'unselectWidget'
		'click #delete-grid-widget'	: 'deleteWidget'
		'click #edit-grid-widget'	: 'openEditDialog'

	openEditDialog : ->
		console.log 'Opening edit dialog'

	deleteWidget : ->
		# Отключяем кнопки удаления и редактирования
		@$deleteWidget.attr('disabled' , 'disabled');
		@$editWidget.attr('disabled' , 'disabled');

		@$gridster.remove_widget @$selectedWiget
		@selectedWiget = null


	unselectWidget : ->
		if @$selectedWiget?
			@$selectedWiget.css 'background' : '#ddd'
		@$selectedWiget = null

	addWidget : (e) ->
		console.log 'Click add widget'
		@$gridster.add_widget '<li>Клик по элементу для изменения параметров</li>' , 1 , 1

	clickWidget : (e) ->
		console.log 'Click on widget'
		if @$selectedWiget?
			@$selectedWiget.css 'border' : '1px dashed #ccc'

		@$selectedWiget = $ e.target

		# Активируем кнопку удаления и редактирования
		@$deleteWidget.removeAttr('disabled');
		@$editWidget.removeAttr('disabled');
		
		# Выделеям виджет
		@$selectedWiget.css 'border' : '1px solid #ccc'





# INITIALIZE VIEWS
AdminApp.initViews.categoryParameters 	= new AdminApp.Views.categoryParameters()
AdminApp.initViews.viewsGridSystem		= new AdminApp.Views.viewsGridSystem()