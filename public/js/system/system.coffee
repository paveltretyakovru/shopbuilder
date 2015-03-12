window.AdminApp = 
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
	responseData		: {}
	$selectedWiget 		: null
	$deleteWidget		: $ '#delete-grid-widget'
	$editWidget			: $ '#edit-grid-widget'
	$editModal	 		: $ '#edit-widget-modal'
	
	# templates
	$templateTextEditor : $ '#template-text-editor'
	$templateLoadImage 	: $ '#template-load-views-image'
	$templateParameters : $ '#product-parameters-template'
	$templateProductTitle : $ '#product-title-template' 

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
			# Описываем сохранение виджетов
			serialize_params		: ($w , wgd) =>
				@serializeParameters $($w) , wgd
		.data 'gridster'

		# Слушаем отрктие редактора
		@$editModal.on 'shown.bs.modal' , =>
			console.log 'Открываем редактор для ' +  @$selectedWiget.attr 'data-widget-type'
			@initEditor  @$selectedWiget.attr 'data-widget-type'

		@$editModal.on 'hide.bs.modal' , =>
			@$widgetEditorBody.html ' '
			@$widgetEditorBody.append '<div class="loader"></div>'

	events 		:
		'click #add-grid-widget'			: 'addWidget'
		'click .gs-w'						: 'clickWidget'
		'click #delete-grid-widget'			: 'deleteWidget'
		'click #edit-grid-widget'			: 'openEditDialog'
		'click #widget-save-changes'		: 'saveWidgetContent'
		'submit #widget-editor-body form' 	: 'loadImage'
		'click #serialize-grid'				: ' '

	# Функция для сохранения видов блока
	serializeParameters : (widget , wgd) ->
		type    = widget.attr 'data-widget-type'
		
		# Прописываем нужный контент для системы
		switch type
			when 'title'
				content = "{!! @include('products.title') !!}"
			when 'parameters'
				content = "{!! @include('parameters.list') !!}"

			else content = widget.html()

		params = 
			id 	: wgd.el[0].id,
			col : wgd.col,
			row : wgd.row,
			htmlContent: content

		params

	serializeGrid : ->
		test = @$gridster.serialize()
		console.log test

	# Сохраняем изменения полученные от редактора виджетов
	saveWidgetContent : ->
		type = @$selectedWiget.attr('data-widget-type');
		switch type
			when 'text'
				@saveTextWidget()
			when 'image'
				@saveImageWidget()

	
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

	saveImageWidget : ->
		console.log 'Close image widget'
		# Добавляем новый блок в ктором будет фоновое изображение, а так же метку растягивания виджета
		@$selectedWiget.html('<div class="image-widget-backdiv"></div><span class="gs-resize-handle gs-resize-handle-both"></span>')
		
		imagediv = @$selectedWiget.find('.image-widget-backdiv');
		# Вставляем фоновое, загруженное изображение
		imagediv.css 'background-image' 	: 'url(' + @responseData.imageurl + ')'



	loadImage : (e) ->
		e.preventDefault()
		form 	= e.target
		data 	= new FormData form
		xhr 	= new XMLHttpRequest()
		pb 		= $('#progress-load-image').find '.progress-bar'
		status 	= $ '#status-load-image'
		resdiv	= $ '#result-load-image'

		if $(form).find('input[type=file]').val() != ''
			xhr.open 'POST' , form.action
			xhr.onload = (e) =>
				status.text e.currentTarget.responseText
				result = JSON.parse e.currentTarget.responseText
				console.log result.imageurl
				resdiv.css('background-image' , 'url('+result.imageurl+')')
				@responseData = result

			xhr.upload.onprogress = (e) ->
				pb.attr "aria-valuenow" , e.loaded / e.total * 100
				pb.css "width" , (e.loaded / e.total * 100) + '%'

			xhr.send data
		else
			status.text "Необходимо выбрать файл"

	initImageEditor : ->
		console.log 'Init image editor'
		@$widgetEditorBody.html(@$templateLoadImage.html());
		# Инициализирукм прогресс бар
		#$('#progress-load-image').progressbar
		#	option :
		#		value : false
		# Проверяем возможность загрузки изображий
		if not window.FormData
			$('#status-load-image').text "Ваш браузер не потдерживает FormData"


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
		
		el 	 = $ e.target
		type = el.attr 'data-widget-type'
		text = el.text()					# текст в виджете

		# Если перед добавлением виджета необходимы действия
		switch type
			when 'parameters'
				text = @$templateParameters.html()
			when 'title'
				text = @$templateProductTitle.html()
		
		@$gridster.add_widget '<li data-widget-type="'+type+'" class="'+type+'-widget">'+text+'</li>' , 4 , 4

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