<?php

date_default_timezone_set('America/Guatemala'); 
	
	function fechaC(){
		$mes = array("","Enero", 
					  "Febrero", 
					  "Marzo", 
					  "Abril", 
					  "Mayo", 
					  "Junio", 
					  "Julio", 
					  "Agosto", 
					  "Septiembre", 
					  "Octubre", 
					  "Noviembre", 
					  "Diciembre");
		return date('d')." de ". $mes[date('n')] . " de " . date('Y');
	}

	function Hora(){
		setlocale(LC_TIME,"es_GT");
			
		echo strftime(" %H:%M %p");
		// echo strftime("%a, %H:%M");
		//echo strftime("%Y-%B");
	}

?>