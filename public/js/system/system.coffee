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
	el 					: '#gridster-system'	
	$gridster			: {}
	quillObject			: {}
	$selectedWiget 		: null
	$deleteWidget		: $ '#delete-grid-widget'
	$editWidget			: $ '#edit-grid-widget'
	$editModal	 		: $ '#edit-widget-modal'
	$templateTextEditor : $ '#template-text-editor'
	$templateLoadImage 	: $ '#template-load-views-image'
	$widgetEditorBody	: $ '#widget-editor-body'
	idTextEditor		: 'full-editor'
	idTextEditorsToolbar: 'full-toolbar'

	initialize 	: ->
		console.log 'Inititalize viewsGridSystem'
		# Инициализируем сетку
		@$gridster = $('.gridster > ul').gridster
			widget_margins			: [2, 2]
			widget_base_dimensions	: [25 , 25]
			autogrow_cols			: true
			max_cols				: 25
			resize : 
				enabled : true
		.data 'gridster'

		# Слушаем отрктие редактора
		@$editModal.on 'shown.bs.modal' , =>
			console.log 'Открываем редактор для ' +  @$selectedWiget.attr 'data-widget-type'
			@initEditor  @$selectedWiget.attr 'data-widget-type'

		@$editModal.on 'hide.bs.modal' , =>
			@$widgetEditorBody.html ' '

	events 		:
		'click #add-grid-widget'	: 'addWidget'
		'click .gs-w'				: 'clickWidget'
		'click #delete-grid-widget'	: 'deleteWidget'
		'click #edit-grid-widget'	: 'openEditDialog'
		'click #widget-save-changes': 'saveWidgetContent'

	# Сохраняем изменения полученные от редактора виджетов
	saveWidgetContent : ->
		type = @$selectedWiget.attr('data-widget-type');
		switch type
			when 'text'
				@saveTextWidget()
	
	# Событие при нажатии на кнопку сохранить изменения в редакторе виджетов
	# ЕСЛИ ОТКРЫТ РЕДАКТОР ТЕКСА
	saveTextWidget : ->
		html = @quillObject.getHTML()
		console.log html
		@$selectedWiget.html(html + '<span class="gs-resize-handle gs-resize-handle-both"></span>')

	# Обработка события при открытии окна с редактором виджетов
	openEditDialog : ->
		# Обработчика не нужно!!! Обработчик срабатывает автоматом в bootstrap.js
		# В инициализации поставлена прослушка на откртие модального окна

	# Инициализируем модальное окно радактора виджетов
	initEditor 	: (type) ->
		switch	type
			when 'text'
				@initTextEditor()

			when 'image'
				@initImageEditor()

	initImageEditor : ->
		console.log 'Init image editor'
		@$widgetEditorBody.html(@$templateLoadImage.html());

	# Инициализируем тектовый редактор
	initTextEditor : ->
		# сохраняем текущий контент
		content = @$selectedWiget.html();
		# вставляем шаблон текстового редактора в модальное окно
		@$widgetEditorBody.html(@$templateTextEditor.html());
		# Вставляем вставляем контент виджета
		$('#' + @idTextEditor).html(content)
		# Применяем плагин текстовго редактора
		@quillObject = makeQuill @idTextEditor , @idTextEditorsToolbar 

	# Событие нажатия на кнопку - Удалить
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

	# Событие при нажатии на ссылки добавления виджетов
	addWidget : (e) ->
		e.preventDefault()
		el 	= $ e.target

		type = el.attr('data-widget-type');
		console.log 'Click add widget ' + type
		@$gridster.add_widget '<li data-widget-type="'+type+'">Виджет '+el.text()+'</li>' , 3 , 3

	# Выделение кликнутого виджета и работа с ним
	clickWidget : (e) ->
		e.preventDefault()
		el = $ e.target
		
		# Работает только с самим блоком
		if not el.is 'li'
			el = el.parent 'li.gs-w'

		console.log 'Click on widget'
		if @$selectedWiget?
			@$selectedWiget.css 'border' : '1px dashed #ccc'

		@$selectedWiget = el

		# Активируем кнопку удаления и редактирования
		@$deleteWidget.removeAttr('disabled');
		@$editWidget.removeAttr('disabled');
		
		# Выделеям виджет
		@$selectedWiget.css 'border' : '1px solid #ccc'





# INITIALIZE VIEWS
AdminApp.initViews.categoryParameters 	= new AdminApp.Views.categoryParameters()
AdminApp.initViews.viewsGridSystem		= new AdminApp.Views.viewsGridSystem()

###
$('#typeWidget').on 'change' , ->
	console.log "Test change"
###