<?php
	/**
	* Clase compara Extiende main
	* Controlador: /compara/*
	* Obtiene la información para comparar escuelas presentando los datos en forma de mapa y tabla. De igual forma gestiona las búsquedas de escuelas.
	*/
class compara extends main{
	
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para mostrar adecuadamente la vista compara/index
	*/
	public function index(){
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		$this->load_compara_cookie();
		$this->get_metadata();
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
		if($this->get('term') && isset($this->config->solr_server)){
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

	/**
	* Funcion Publica mapa.
	* Lee la información de las escuelas para renderizar el mapa de /compara/mapa
	*/
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

	/**
	* Funcion Publica escuelas.
	* Lee la información de las escuelas para mostrar la tabla de comparación
	*/
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
		$this->meta_description = "¿Buscas la mejor escuela cerca de tu casa o trabajo? En Mejora tu escuela puedes comparar las escuelas públicas y privadas de tu estado, delegación, municipio y colonia. Conoce el semáforo educativo de preescolar, primarias, secundarias y bachilleratos de otras escuelas.";

		$this->include_theme('index','index');
	}

	/**
	* Funcion Publica get_metadata.
	* Contiene los datos a mostrar en el meta tag description a las vistas que pertenezcan a este controlador
	*/
	public function get_metadata(){
		$this->meta_description = "¿Sabes qué lugar ocupa tu estado en educación a nivel nacional? En Mejora tu escuela puedes buscar las mejores primarias, secundarias y prepas de tu estado y comparar sus resultados en la prueba ENLACE con las otras escuelas de México.";
	}
}
?>
