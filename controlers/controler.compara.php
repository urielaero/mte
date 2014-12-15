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
		$this->meta_description = "Consulta información sobre las características de las escuelas de México. Datos de contacto, información sobre desempeño, infraestructura, programas de apoyo y conoce las opiniones de otros padres de familia.";
		if(!$this->get('search')){ 
			$this->get_location();
			$params = new stdClass();
			$params->entidad = $this->user_location->id; 
			if($this->config->search_location)
				$this->resultados_title = 'Mejores escuelas en '.$this->capitalize($this->user_location->nombre);
		}else{
			$this->breadcrumb = array('/compara'=> 'Comparador','#'=> 'Busqueda');
		}
		if($this->get('term') && isset($this->config->solr_server)){
			$params = new StdClass();
			$params->term = $this->get('term');
			$params->control = $this->get('control');
			$params->nivel = $this->get('nivel');
			$params->entidad = $this->get('entidad');
			$params->municipio = $this->get('municipio');
			$params->localidad = $this->get('localidad');
			$params->poco_confiables = $this->get('poco_confiables');
			$params->eval_entre_programados = $this->get('eval_entre_programados');
			$p = $this->get('p') ? $this->get('p') : 1;
			$this->get_escuelas_new($params,$p);
			
			$this->cct_count_entidad();
			$this->resultados_title = 'Resultados de tu búsqueda';
			$this->set_info_user_search($this->num_results);
			$this->include_theme('index','resultados');
		}else{
			$params = isset($params)?$params:new stdClass();
			$params->pagination = 6;
			$params->order_by = ' ISNULL(escuelas_para_rankeo.rank_entidad), escuelas_para_rankeo.rank_entidad ASC, escuelas_para_rankeo.promedio_general DESC';
			$this->get_escuelas($params);

			$this->set_info_user_search(isset($this->pagination->total_results) ? $this->pagination->total_results : 0);
			$this->process_escuelas();
			$this->cct_count_entidad();
			if(!$this->cookie('user_location')){
				$this->draw_map = true;
			}
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
		$params = new stdClass();
		//if(!$this->request('search')){
		//$params->entidad = $this->user_location ? $this->user_location : 9 ;
		//}
		$params->pagination = 100;		
		$params->order_by = 'escuelas.nombre ASC';		
		$this->debug = false;
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
		#$this->debug=true;
		$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();
		
		$this->header_folder = 'compara';		
		$this->subtitle_header = 'Esta herramienta te ayuda a comparar la calidad <br />educativa de tu escuela con la de otras <br />similares o cercanas.';
		$this->draw_map = true;
		$this->load_compara_cookie();
		$params = new stdClass();
		$params->ccts = explode('-',$this->get('id'));
		$params->order_by = 'escuelas_para_rankeo.promedio_general DESC';
		$params->limit =  '0,100';
		if(count($params->ccts)){
            $params->one_turn = true;
			$this->get_escuelas($params);		
			$this->process_escuelas();
			$this->cct_count_entidad();
		}
		$this->breadcrumb = array('#'=>'Comparador');

		$this->resultados_title = 'Resultados de tu búsqueda';

		if($this->get('search')){ 
			$this->get_location();
			$params->entidad = $this->user_location ? $this->user_location->id : 9 ;
			if($this->config->search_location)
				$this->resultados_title = 'Mejores escuelas en '.$this->capitalize($this->user_location->nombre);
			else if(($entidad = $this->get('entidad'))){
				$municipio = new entidad($entidad,$this->conn);
				$municipio->read('nombre');
				$this->resultados_title = 'Mejores escuelas en '.$this->capitalize($municipio->nombre);
			}
		}
		$this->meta_description = "¿Buscas la mejor escuela cerca de tu casa o trabajo? En Mejora tu escuela puedes comparar las escuelas públicas y privadas de tu estado, delegación, municipio y colonia. Compara el semáforo educativo y consulta información sobre infraestructura y programas de apoyo de preescolares, primarias, secundarias y bachilleratos de todo el país.";

		$this->include_theme('index','index');
	}

	/**
	* Funcion Publica get_metadata.
	* Contiene los datos a mostrar en el meta tag description a las vistas que pertenezcan a este controlador
	*/
	public function get_metadata(){
		$this->meta_description = "Consulta información sobre las características de las escuelas de México. Datos de contacto, información sobre desempeño, infraestructura, programas de apoyo y conoce las opiniones de otros padres de familia.";
	}

	public function get_data_table(){
		$name_entidad = $this->request('name_entidad');
		$entidad = new entidad(NULL,$this->conn);
		$entidad->search_clause = " entidades.nombre = \"$name_entidad\"";
		$en = $entidad->read('id,nombre');
		$params = new stdClass();
		$params->entidad = $en[0]->id;
		if(!$params->entidad){
			$this->get_location();
			$params->entidad = $this->user_location->id;
			$name_entidad = $this->user_location->nombre;
		}
		$params->pagination = 6;
		$params->order_by = ' ISNULL(escuelas_para_rankeo.rank_entidad), escuelas_para_rankeo.rank_entidad ASC, escuelas_para_rankeo.promedio_general DESC';
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->cct_count_entidad();
		$this->resultados_title = 'Mejores escuelas en '.$this->capitalize($name_entidad);
		$this->set_cookie('user_location',$name_entidad."-".$params->entidad);
		$this->include_template("resultados-escuela","compara"); 
	}

}
?>
