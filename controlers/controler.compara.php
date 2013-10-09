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
		$this->principal = true;
		$this->title_header = 'Conoce tu escuela';
		if(!$this->get('search')){ 
			$this->get_location();
			$params->entidad = $this->user_location ? $this->user_location->id : 9 ;
			$this->resultados_title = 'Mejores escuelas en '.$this->capitalize($this->user_location->nombre);
		}else{
			$this->breadcrumb = array('/compara'=> 'Comparador','#'=> 'Busqueda');
		}
		if($this->get('term')){
			//$params = new new StdClass();
			$params->term = $this->get('term');
			$params->control = $this->get('control');
			$params->nivel = $this->get('nivel');
			$params->entidad = $this->get('entidad');
			$params->municipio = $this->get('municipio');
			$params->localidad = $this->get('localidad');
			$p = $this->get('p') ? $this->get('p') : 1;
			$this->get_escuelas_new($params,$p);
			
			$this->cct_count_entidad();
			$this->resultados_title = 'Resultados de tu búsqueda';
			$this->set_info_user_search($this->num_results);
			$this->include_theme('index','resultados');
		}else{
			$params->pagination = 6;
			$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC';

			$this->get_escuelas($params);
			$this->set_info_user_search($this->pagination->total_results);
			$this->process_escuelas();
			$this->cct_count_entidad();
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
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		
		$this->header_folder = 'compara';		
		$this->subtitle_header = 'Esta herramienta te ayuda a comparar la calidad <br />educativa de tu escuela con la de otras <br />similares o cercanas.';
		$this->draw_map = true;
		$this->load_compara_cookie();
		$params->ccts = explode('-',$this->get('id'));
		$params->order_by = 'escuelas.promedio_general DESC';
		$params->limit =  '0,100';
		if(count($params->ccts)){
			$this->get_escuelas($params);		
			$this->process_escuelas();
			$this->cct_count_entidad();
		}
		$this->resultados_title = 'Resultados';
		$this->breadcrumb = array('#'=>'Comparador');

		$this->resultados_title = 'Resultados de tu búsqueda';

		if(!$this->post('search')){ 
			$this->get_location();
			$params->entidad = $this->user_location ? $this->user_location->id : 9 ;
			$this->resultados_title = 'Mejores escuelas en '.$this->capitalize($this->user_location->nombre);
		}

		$this->include_theme('index','index');
	}
	public function get_meta_description(){
		echo '<meta name="description" content="Escuelas comparadas: ';
		$i=0;
		for($i=0;$i<count($this->escuelas)-1;$i++){
			echo $this->capitalize($this->escuelas[$i]->nombre).', ';
		}
		echo $this->capitalize($this->escuelas[$i]->nombre);
		echo ' via https://www.facebook.com/MejoraTuEscuela" />';	
	}
}
?>
