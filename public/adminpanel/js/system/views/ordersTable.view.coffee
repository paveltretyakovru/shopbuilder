AdminApp.Views.ordersTable = Backbone.View.extend
	el 			: '#ordersTableContainer'

	initialize : ->
		console.log "Initialize orders table"


AdminApp.initViews.ordersTable = new AdminApp.Views.ordersTable();