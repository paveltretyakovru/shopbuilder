###
		Вид для выпадающего списка с готовыми шаблонами для редактирования вида товаров
		Подробные комментарии смотреть в viewsTemplates.view.coffee в этом же каталоге
###

AdminApp.Views.viewsTemplates = Backbone.View.extend
	el : '#views-templates-list'

	currentTemplate : {} # После выбора шаблона, сохраняется ссылка на объект шаблона

	initialize : ->
		console.log 'Init viewsTemplates view test'

		window.testTemplate = @viewsTemplatesList[0];

		# Вставляем готовые шаблоны в выпадающий список
		@initTemplatesList()

	events :
		'click' : 'insertViewsTemplate' # 

	insertViewsTemplate : (e) ->
		console.log 'insertViewsTemplate function'
		
		e.preventDefault()
		
		el 	 = $ e.target
		num  = el.attr 'data-template-num'

		@currentTemplate = @viewsTemplatesList[num]
		console.log @currentTemplate



	initTemplatesList : ->
		# Элемент списка содержит атрибут data-template-num - для быстрого обращения по индексу к общему масиву шаблонов
		_.each @viewsTemplatesList , (template , num) =>
			@$el.append '<li><a href="#" data-template-type="'+template.type+'" data-template-num="'+num+'">'+template.title+'</a></li>'

	# Готовые шаблоны для плагина gridster, созданы с помощью функции sereliaze()
	# Нужно будет расширить функционал для создания общих шаблонов
	viewsTemplatesList : [
		title 	: "Телефоны"
		type	: "phones"
		template : `[{"id":"","col":1,"row":1,"htmlContent":"<div class=\"image-widget-backdiv\" style=\"background-image: url(http://localhost:8000/upimages/products_1_87543.jpeg);\"></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"},{"id":"","col":11,"row":8,"htmlContent":"<div><span style=\"font-size: 18px;\"><b>Корпус с отделкой под настоящую кожу</b></span></div><div style=\"text-align: justify;\"><span style=\"color: rgb(41, 41, 41); font-family: Arial, sans-serif;\">Оформленный «под кожу» корпус Samsung GALAXY Note3 Neo с отделкой декоративным стежком мгновенно выделяет смартфон среди других моделей и привлекает взгляды. Покрытие «под кожу» не только придает устройству элегантность и дополнительно защищает корпус от царапин, но и удобно ложится в ладонь, не грозя выскользнуть при неловком движении. Тонкость и изящество смартфона производят незабываемое впечатление. Вы можете придерживаться традиционной черной или белой цветовой схемы или попробовать более смелый ментоловый оттенок, если хотите выразить свое чувство стиля и оригинальность</span></div><div><br></div><span class=\"gs-resize-handle gs-resize-handle-both\"></span>"},{"id":"","col":11,"row":1,"htmlContent":"<%= title %>"},{"id":"","col":11,"row":3,"htmlContent":"<%= parameters %>"}]`
	]

AdminApp.initViews.viewsTemplates = new AdminApp.Views.viewsTemplates();