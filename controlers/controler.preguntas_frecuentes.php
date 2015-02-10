<?php

/**
* Clase preguntas_frecuentes Extiende main.
* Controlador: host/preguntas_frecuentes
*/
class preguntas_frecuentes extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		$this->breadcrumb = array('#'=>'Preguntas frecuentes');
		$this->page_title = 'Preguntas frecuentes | Mejora tu Escuela';
		$this->include_theme('index','index');		
	}
}
?>
