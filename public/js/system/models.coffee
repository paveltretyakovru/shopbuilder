# Модели системы

AdminApp.Models.Product = Backbone.Model.extend
	urlRoot : '/products'

	initialize	: ->
		console.log "Initialize product model"