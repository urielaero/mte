<?php
class compara extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->get_location();
		$this->header_folder = 'compara';
		$params->limit = '0,10';
		$params->entidad = $this->request('entidad') ? $this->request('entidad') : ( $this->user_location ? $this->user_location : 9 ) ;
		
		$params->order_by = 'escuelas.promedio_general DESC';
		$this->get_escuelas($params);
		$this->include_theme('index','resultados');
	}
}
?>