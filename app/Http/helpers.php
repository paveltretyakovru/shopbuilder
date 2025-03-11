<?php
	function delete_form($routeParams , $label = 'Удалить'){
		$form = Form::open(['route' => $routeParams, 'method' => 'DELETE']);
		$form .= Form::submit($label , ['class' => 'btn btn-danger']);
		return $form .= Form::close();
	}

	function explodeParameters($parameters){
		if (strpos($parameters, ',')) {
			return explode(',', $parameters);
		}else{
			return [$parameters];
		}
	}
?>