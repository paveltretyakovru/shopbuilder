AdminApp.Models.Order = Backbone.Model.extend
	urlRoot : '/admin/orders'

	initialize	: ->
		console.log "Initialize order model"