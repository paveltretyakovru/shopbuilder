AdminApp.helpers.escapeHtml = (text) ->
	map =
		'&': '&amp;'
		'<': '&lt;'
		'>': '&gt;'
		'"': '&quot;'
		"'": '&#039;'

	text.replace /[&<>"']/g , (m) -> map[m]