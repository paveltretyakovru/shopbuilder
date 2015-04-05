###
		Вид для выпадающего списка с готовыми шаблонами для редактирования вида товаров
		Подробные комментарии смотреть в viewsTemplates.view.coffee в этом же каталоге
###

AdminApp.Views.viewsTemplates = Backbone.View.extend
	el : '#views-templates-list'

	currentTemplate : {} # После выбора шаблона, сохраняется ссылка на объект шаблона
	$gridster		: AdminApp.globalObjects.$gridster

	initialize : ->
		console.log 'Init viewsTemplates view test' , @$gridster

		window.testTemplate = @currentTemplate

		# Вставляем готовые шаблоны в выпадающий список
		@initTemplatesList()

	events :
		'click' : 'selectTemplate' # Событие выбора шаблона

	# Обрабатывает событие выбора шаблона в списке шаблонов
	selectTemplate : (e) ->
		console.log 'insertViewsTemplate function'
		
		e.preventDefault()
		
		el 	 = $ e.target
		num  = el.attr 'data-template-num'

		# Создаём ссылку на объект с шаблоном
		@currentTemplate = @viewsTemplatesList[num]
		console.log 'Current template: ' , @currentTemplate
		# Рендерим контент gridster.js ячеек, необходимо в случае содержания данных товара в ячейке
		@renderGridsterTemplate()

	renderGridsterTemplate : ->
		_.each @currentTemplate.template , (cell , index) =>
			compiled = _.template(cell.htmlContent)			
			cell.htmlContent = compiled @model.toJSON()

		console.log @currentTemplate.template
		@createGridster()

	createGridster : ->
		@$gridster.remove_all_widgets()
		_.each @currentTemplate.template , (cell , index) =>
			widget = @$gridster.add_widget '<li data-widget-type="'+cell.type+'" class="'+cell.type+'-widget">'+cell.htmlContent+'</li>', cell.size_x, cell.size_y, cell.col, cell.row
			@$gridster.resize_widget widget , cell.size_x , cell.size_y


	# Инициализируем список шаблонов
	initTemplatesList : ->
		# Элемент списка содержит атрибут data-template-num - для быстрого обращения по индексу к общему масиву шаблонов
		_.each @viewsTemplatesList , (template , num) =>
			@$el.append '<li><a href="#" data-template-type="'+template.type+'" data-template-num="'+num+'">'+template.title+'</a></li>'

	# Готовые шаблоны для плагина gridster, созданы с помощью функции sereliaze()
	# Нужно будет расширить функционал для создания общих шаблонов
	viewsTemplatesList : [
		title 	: "Телефоны"
		type	: "phones"
		# Обращаю внимание в члене template содержится нативный js, заключенный в ``, так как содержит большой JSON
		template : `[{"id":"","col":1,"row":1,"size_x":25,"size_y":2,"type":"title","htmlContent":"<div class=\"product-title\"><%= title %></div>\n\t"},{"id":"","col":11,"row":3,"size_x":7,"size_y":5,"type":"parameters","htmlContent":"<%= parameters %>"},{"id":"","col":11,"row":8,"size_x":15,"size_y":9,"type":"text","htmlContent":"<div><b><span style=\"font-size: 18px;\">Корпус с отделкой под настоящую кожу</span></b></div><div style=\"text-align: justify;\">Оформленный «под кожу» корпус Samsung GALAXY Note3 Neo с отделкой декоративным стежком мгновенно выделяет смартфон среди других моделей и привлекает взгляды. Покрытие «под кожу» не только придает устройству элегантность и дополнительно защищает корпус от царапин, но и удобно ложится в ладонь, не грозя выскользнуть при неловком движении. Тонкость и изящество смартфона производят незабываемое впечатление. Вы можете придерживаться традиционной черной или белой цветовой схемы или попробовать более смелый ментоловый оттенок, если хотите выразить свое чувство стиля и оригинальность</div><div><br></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"},{"id":"","col":1,"row":3,"size_x":10,"size_y":14,"type":"image","htmlContent":"<div class=\"image-widget-backdiv\" style=\"background-image: url(http://localhost:8000/upimages/products_1_39238.jpeg);\"></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"}]`
	]

# Инициализация вида
AdminApp.initViews.viewsTemplates = new AdminApp.Views.viewsTemplates
		model : AdminApp.initModels.Product