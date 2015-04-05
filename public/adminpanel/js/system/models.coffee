# Модели системы

AdminApp.Models.Product = Backbone.Model.extend
	urlRoot : '/admin/products'

	initialize	: ->
		console.log "Initialize product model"