<?php
class compara extends main{
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_compara_cookie();
		$this->breadcrumb = array('#'=> 'Comparador');
		$this->resultados_title = 'Resultados';
		$this->header_folder = 'compara';		
		if(!$this->get('search')){ 
			$this->get_location();
			$params->entidad = $this->user_location ? $this->user_location->id : 9 ;
			$this->resultados_title = 'Mejores escuelas en '.$this->capitalize($this->user_location->nombre);
		}else{
			$this->breadcrumb = array('/compara'=> 'Comparador','#'=> 'Busqueda');
		}
		if($this->get('term')){
			$params->term = $this->get('term');
			$params->control = $this->get('control');
			$params->nivel = $this->get('nivel');
			$params->entidad = $this->get('entidad');
			$params->municipio = $this->get('municipio');
			$params->localidad = $this->get('localidad');
			$p = $this->get('p') ? $this->get('p') : 1;
			$this->get_escuelas_new($params,$p);			
			$this->include_theme('index','resultados');
		}else{
			$params->pagination = 6;
			$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC';
			$this->get_escuelas($params);
			$this->process_escuelas();			
			$this->include_theme('index','resultados-escuela');
		}
		
	}
	public function mapa(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_compara_cookie();
		$this->user_location = false;
		$this->draw_map = true;
		if(!$this->request('search')){
			$params->entidad = $this->user_location ? $this->user_location : 9 ;
		}
		$params->pagination = 100;		
		$params->order_by = 'escuelas.nombre ASC';		
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->escuelas_digest->zoom += 1;
		$this->header_folder = 'compara';
		$this->include_theme('index','map');
	}
	public function escuelas(){
		$this->header_folder ='escuelas';
		$this->draw_map = true;
		$this->load_compara_cookie();
		$params->ccts = explode('-',$this->get('id'));
		$params->order_by = 'escuelas.promedio_general DESC';
		if(count($params->ccts)){
			$this->get_escuelas($params);		
			$this->process_escuelas();
		}
		$this->resultados_title = 'Resultados';
		$this->breadcrumb = array('#'=>'Comparador');
		$this->include_theme('index','index');
	}
}
?>
