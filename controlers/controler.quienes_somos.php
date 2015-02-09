<?php

/**
* Clase quienes_somos Extiende main.
* Controlador: host/quienes_somos
*/
class quienes_somos extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->page_title = '¿Quiénes somos? | Mejora tu escuela';
		$this->meta_description = 'MejoraTuEscuela.org es una iniciativa ciudadana, independiente y sin fines de lucro. Nuestro equipo está integrado por miembros del Instituto Mexicano para la Competitividad A.C. (IMCO) con apoyo de la fundación Omidyar Network.';
		$this->title_header = '¿Quiénes somos?';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'¿Quiénes somos?');
		$this->subtitle_header = '
			MejoraTuEscuela.org es una plataforma que busca <br />
			promover la participación ciudadana para transformar <br />
			la educación en México.';
		$this->header_folder = 'escuelas';
		$this->include_theme('index','index');
	}
}

?>
