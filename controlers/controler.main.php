<?php
	/** 
	* Clase Principal main.
	* Clase que hereda las utilidades necesarias para conectar los controladores
	* Contiene métodos y atributos que podrán ser usados por todos los controladores.
	*/
class main extends controler{
	/** 
	* Constructor de la Clase main.
	* Realiza la conexión con la base de datos y deja disponible variables que se usaran en todas los controladores
	* Constructor main recive el parametro $config
	* \param $config 
	*/

	public function main($config){

	
		//error_reporting(1);
		//ini_set('display_errors', '1');

		$this->config = $config; 
		$this->dbConnect(); 
		$this->location = get_class($this); 
		$this->header_folder = 'home'; 
		$this->page_title = 'Mejora tu Escuela'; 
		$this->breadcrumb = false; 
		$this->draw_map = false; 
		$this->draw_charts = false; 
		$this->get_data_compara_float();
		$this->load_entidades();
		#$this->testMail();
	}

	/** 
	* Funcion Protegida process_escuelas.
	* A partir de las datos contenidos en el atributo 'escuelas' crea un atributo de tipo objeto con datos necesarios para 
	* mostrar el mapa y además contiene un arreglo asociativo de objetos donde la llave es el CCT y los datos contenidos en 
	* dicho objeto es la información que es usada de las escuelas.
	*/
	protected function process_escuelas(){
		
		$this->escuelas_digest = false;
		if($this->escuelas){
			$escuelas = array();
			foreach($this->escuelas as $key => $escuela){
				if($key == 0){
					$minlat = $maxlat = $escuela->latitud;
					$minlong = $maxlong = $escuela->longitud;
				}else{
					if($escuela->latitud < $minlat) $minlat = $escuela->latitud;
					else if($escuela->latitud > $maxlat) $maxlat = $escuela->latitud;
					if($escuela->longitud < $minlong) $minlong = $escuela->longitud;
					else if($escuela->longitud > $maxlong) $maxlong = $escuela->longitud;
				}
				$escuela->get_semaforo();
				$escuelas[$escuela->cct] = new stdClass();
				$escuelas[$escuela->cct]->cct = $escuela->cct;
				$escuelas[$escuela->cct]->latitud = $escuela->latitud;
				$escuelas[$escuela->cct]->longitud = $escuela->longitud;
				$escuelas[$escuela->cct]->nombre = $this->capitalize($escuela->nombre);
				$escuelas[$escuela->cct]->localidad = $this->capitalize($escuela->localidad->nombre);
				$escuelas[$escuela->cct]->entidad = $this->capitalize($escuela->entidad->nombre);
				$escuelas[$escuela->cct]->nivel = $this->capitalize($escuela->nivel->nombre);
				$escuelas[$escuela->cct]->control = $this->capitalize($escuela->control->nombre);
				$escuelas[$escuela->cct]->semaforo = $escuela->semaforo;
				$escuelas[$escuela->cct]->promedio_general = $escuela->promedio_general;
				$escuelas[$escuela->cct]->promedio_matematicas = $escuela->promedio_matematicas;
				$escuelas[$escuela->cct]->promedio_espaniol = $escuela->promedio_espaniol;
				$escuelas[$escuela->cct]->rank = $escuela->rank_entidad;
				$escuelas[$escuela->cct]->rank_nacional = $escuela->rank_nacional;
				$escuelas[$escuela->cct]->direccion = $this->capitalize($escuela->localidad->nombre).', '.$this->capitalize($escuela->entidad->nombre);
				$escuelas[$escuela->cct]->promedio_matematicas = $escuela->promedio_matematicas;
				$escuelas[$escuela->cct]->promedio_espaniol = $escuela->promedio_espaniol;
			}
			$width = $this->distance($maxlat,$minlong,$maxlat,$maxlong);
			$height = $this->distance($maxlat,$minlong,$minlat,$minlong);
			$max = $width > $height ? $width : $height;
			$factor = $width > $height ? .20 : .12;
			$scales = array_reverse($this->get_scales(),true);
			foreach($scales as $key => $scale){
				$size = $scale;
				$zoom = $key;
				if($size >= $max) break;
			}
			$response = new stdClass();
			$response->zoom = $zoom+1;
			$response->centerlat = $minlat + (($maxlat - $minlat) / 2);
			$response->centerlong = $minlong + (($maxlong - $minlong) / 2);
			$response->escuelas = $escuelas;
			$this->escuelas_digest = $response;
		}
	}

	/**
	* Funcion Protegida get_scales.
	*/
	protected function get_scales(){
		$scales[0] = 20088000;
		$scales[1] = 10044000;
		$scales[2] = 5022000;
		$scales[3] = 2511000;
		$scales[4] = 1255500;
		$scales[5] = 627750;
		$scales[6] = 313875;
		$scales[7] = 156938;
		$scales[8] = 78469;
		$scales[9] = 39234;
		$scales[10] = 19617;
		$scales[11] = 9809;
		$scales[12] = 4909;
		$scales[13] = 2452;
		$scales[14] = 1226;
		//$scales[15] = 613;
		//$scales[16] = 307;
		//$scales[17] = 153;
		//$scales[18] = 77;
		//$scales[19] = 38;
		return $scales;
    }

    /** 
    * Funcion Publica load_municipios.
    * Lee la información de la tabla municipios los cuales guarda en el atributo 'municipios' y dependiendo si 
    * al momento de la llamada por POST se especifica la variable "entidad" son regresados los municipios de este, 
    * si no es así se muestran todos los municipios además si es especificado la variable json se regresan los resultados en este formato.
	*/
	public function load_municipios(){

		$q = new municipio();
		//$q->debug = true;
		$q->search_clause = $this->request('entidad') ? 'municipios.entidad = "'.$this->request('entidad').'"' : '1';
		$q->search_clause .= ' AND municipios.entidad > 0';
		$q->order_by = 'municipios.nombre';
		$this->municipios = $q->read('id,nombre,entidad=>nombre,entidad=>id');
		if($this->request('json') || true){
			$response = array();
			foreach($this->municipios as $key => $municipio){
				$response[$key] = new stdClass();
				$response[$key]->id = $municipio->id;
				$response[$key]->nombre = $this->capitalize($municipio->nombre).", ".$this->capitalize($municipio->entidad->nombre);
			}
			if($this->request('json')) echo json_encode($response);
		}
}

	/**
	* Funcion Publica load_localidades. 
	* Lee la información de la tabla localidades los cuales guarda en el atributo 'localidades' y dependiendo si 
	* al momento de la llamada por POST se especifica la variable "entidad" o "municipio" son regresados las localidades 
	* con esos filtros, si no es así se muestran todos los municipios además si es especificado la variable json se regresan los resultados en este formato.
	*/
	public function load_localidades(){
		
		if($this->request('entidad') || $this->request('municipio')){
			$q = new localidad();
			$q->search_clause = $this->request('entidad') ? 'localidades.entidad = "'.$this->request('entidad').'"' : '1';
			$q->search_clause = $this->request('municipio') ? 'localidades.municipio = "'.$this->request('municipio').'"' : $q->search_clause;
			$q->order_by = 'localidades.nombre';
			//$q->debug = true;
			$this->localidades = $q->read('id,nombre,entidad=>nombre,entidad=>id');
			if($this->request('json')){
				$response = array();
				foreach($this->localidades as $key => $localidad){
					$response[$key] = new StdClass();
					$response[$key]->id = $localidad->id;
					$response[$key]->nombre = $this->capitalize($localidad->nombre);
				}
				echo json_encode($response);
			}
		}else{
			$this->localidades = false;
		}
		
	}

	/**
	* Funcion Publica get_escuelas.
	* Lee la información de la tabla escuelas aplicando los filtros especificados en la variable $params guarda los
	* datos leidos en el atributo 'escuelas'. Sí al momento de hacer la llamada por POST o GET se encuentra la variable json 
	* la información es presentada en este formato.
	* \param $param establecida false
	*/
	public function get_escuelas($params = false){
		$q = new escuela();
		$q->search_clause .= ' 1 ';
		
		$q->search_clause .= $this->request('term') ? " AND escuelas.nombre LIKE '".$this->request('term')."%' " : '';
		if(isset($params->entidad) && $params->entidad){
			$q->search_clause .= " AND escuelas.entidad = '{$params->entidad}' ";
		}else{
			$q->search_clause .= $this->request('entidad') ? ' AND escuelas.entidad = "'.$this->request('entidad').'" ' : '';
		}
		$q->search_clause .= $this->request('municipio') ? ' AND escuelas.municipio = "'.$this->request('municipio').'" ' : '';
		if(isset($params->localidad) && $params->localidad){
			$q->search_clause .= " AND escuelas.localidad = '{$params->localidad}' ";
		}else{
			$q->search_clause .= $this->request('localidad') ? ' AND escuelas.localidad = "'.$this->request('localidad').'" ' : '';
		}

		if(isset($params->nivel) && $params->nivel){
			$q->search_clause .= " AND escuelas.nivel = '{$params->nivel}' ";
		}else{
			$q->search_clause .= $this->request('nivel') === false || $this->request('nivel') === '' ? 'AND (escuelas.nivel = "12" || escuelas.nivel = "13" || escuelas.nivel = "22") ' : ' AND escuelas.nivel = "'.$this->request('nivel').'" ';
		}

		if(isset($params->control) && $params->control){
			$q->search_clause .= " AND escuelas.control = '{$params->control}' ";
		}else{
			$q->search_clause .= $this->request('control') ? ' AND escuelas.control = "'.$this->request('control').'" ' : '';
		}
		
		if(isset($params->rank_nacional)){
			$q->search_clause .= ' AND rank_nacional >= '.$params->rank_nacional;
		}

		if(isset($params->ccts) && $params->ccts){
			if(count($params->ccts)){
				$q->search_clause = '';
				foreach($params->ccts as $i => $cct){
					$or = $i == 0 ? '(' : ' OR ';
					$q->search_clause .= "$or escuelas.cct = '$cct'";
				}
				$q->search_clause .= " )";
			}
		}
		$q->order_by = isset($params->order_by) ? $params->order_by : 'escuelas.nombre';
		$q->limit= isset($params->limit) ? $params->limit : "0 ,10";
		
		if(isset($params->pagination)){
			$this->pagination = new pagination('escuela',$params->pagination,$q->search_clause);
			$q->limit = $this->pagination->limit;
		}

		$q->debug = isset($this->debug) ? $this->debug : false;
		$this->escuelas = $q->read('id,cct,nombre,poco_confiables,codigopostal,telefono,correoelectronico,paginaweb,turno=>nombre,domicilio,total_evaluados,grados,localidad=>nombre,localidad=>id,entidad=>nombre,entidad=>id,nivel=>nombre,nivel=>id,latitud,longitud,promedio_general,promedio_matematicas,promedio_espaniol,rank_entidad,rank_nacional,control=>id,control=>nombre,municipio=>nombre,municipio=>id,control=>nombre');
		
		if($this->request('json')){
			$response = array();
			if($this->escuelas){
				foreach($this->escuelas as $key => $escuela){
					$response[$key] = new stdClass();
					$response[$key]->label = $this->capitalize($escuela->nombre)." (".$this->capitalize($escuela->nivel->nombre).") ";
					$response[$key]->address = $this->capitalize($escuela->localidad->nombre).', '.$this->capitalize($escuela->entidad->nombre);
					$response[$key]->value = $this->capitalize($escuela->nombre);
					$response[$key]->cct = $escuela->cct;
				}
			}
			echo json_encode($response);
		}
	}

	/**
	* Funcion Publica get_escuelas_new.
	* Realiza una petición al servidor de solr para obtener información de las escuelas para una búsqueda por nombre avanzada, 
	* guarda la información obtenida en el atributo 'escuelas' además del numero de resultados obtenidos en el atributo 'num_results'.
	* \param $params establecida "false"
	* \param $page establecida "false"
	* \param $sort establecida "false"
	*/
	public function get_escuelas_new($params = false,$page = false,$sort = false){
		
		$fq = '(nivel:12 OR nivel:13 OR nivel:22)';
		$q = isset($params->term) && $params->term ? "nombre:".str_replace(' ','~ ',$params->term).'~' : '*:*';
		if($params){
			foreach($params as $key => $param){
				$fq .= $key != 'term' && $param ? " AND $key:$param" : '';
			}
		}
		$start = $page ? ($page-1) * 10 : '0';
		$q = urlencode($q);
		$fq = urlencode($fq);
		$sort = urlencode($sort);
		$url = $this->config->solr_server."select?q=$q&fq=$fq&wt=json&sort=$sort&start=$start";
		$response = file_get_contents($url);
		$response = json_decode($response);
		$this->escuelas = $response->response->docs;
		$this->num_results = $response->response->numFound;
	}

	/**
	* Funcion Publica load_niveles. 
	*Lee la información de la tabla niveles solo para primaria, secundaria y bachillerato guarda los datos en el atributo 'niveles'.
	*/
	public function load_niveles(){
		
		$q = new nivel();
		$q->search_clause = 'niveles.id = "12" || niveles.id = "13" || niveles.id = "22"';
		$this->niveles = $q->read('id,nombre');
	}

	/**
	* Funcion Publica load_entidades.
	* Lee la información de la tabla entidades aplicando opcionalmente el orden con el que se guardaran los datos en el atributo 'entidades'.
	*/
	public function load_entidades($order_by = false){
		
		$q = new entidad();
		$q->search_clause = 'rank > 0';
		if($order_by) $q->order_by = $order_by;
		$this->entidades = $q->read('id,nombre,cct_count,promedio_general,rank');
	}

	/**
	* Funcioin Protegida capitalize.
	* Regresa el valor del parámetro $string con la primera letra en mayúsculas.
	* \param $string a capitalizar
	*/
	protected function capitalize($string){
		
		return $this->mb_ucwords(mb_strtolower($string,'UTF-8'));
		return $string;
	}

	/**
	* Funcion privada mb_ucwords.
	* Regresa el valor del parámetro $str con todas las primeras letras de cada palabra en mayúscula
	* \param $str a transformar
	*/
	private function mb_ucwords($str){
		
	    $str = mb_convert_case($str, MB_CASE_TITLE, "UTF-8"); 
	    return ($str); 
	}

	/**
	* Funcion Privada distance
	* Regresa la distancia aproximada entre la latitud 1 ($lat1),longitud 1 ($long1) y latitud 2 ($lat2),longitud 2 ($long2) 
	* \param $lat1 Latitud 1
	* \param $long1 Longitud 1
	* \param $lat2 Latitud 2
	* \param $long2 Longitud 2
	*/
	private function distance($lat1,$long1,$lat2,$long2){
		
	        $lat1 = deg2rad($lat1);
	        $long1 = deg2rad($long1);
	        $lat2 = deg2rad($lat2);
	        $long2 = deg2rad($long2);
	        $radiusOfEarth = 6371000;// Earth's radius in meters.
	        $diffLatitude = $lat1 - $lat2;
	        $diffLongitude = $long1 - $long2;
	        $a = sin($diffLatitude / 2) * sin($diffLatitude / 2) +
	            cos($lat2) * cos($lat1) *
        	    sin($diffLongitude / 2) * sin($diffLongitude / 2);
	        $c = 2 * asin(sqrt($a));
	        $distance = $radiusOfEarth * $c;
	        return $distance;
    }

    /**
    * Funcion Protegida get_location.
    * Obtiene la localización basada en la IP del usuario usando http://freegeoip.net/ además el atributo de configuración
    * search_location deberá tener valor evaluado como True
    */
    protected function get_location(){
    	

	/*
	for test
	*/
	if(!($location_cookie = $this->cookie('user_location')) && $this->config->search_location){
    		$ip = 
    			isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] :
    			isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] :
    			isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';    	
			$url = "http://freegeoip.net/json/$ip";
			$location_request = file_get_contents($url);
			$location = json_decode($location_request);
		//var_dump($location);
    		if(isset($location) && $location->region_code != '' && $location->country_code == 'MX'){
			//$this->user_location = new entidad(9);
			$this->user_location = new entidad($location->region_code);
			$this->user_location->read('id,nombre');
		}else{
			$this->user_location = new entidad(rand(1,32));
			$this->user_location->read('nombre,id');
		}
		$this->set_cookie('user_location',$this->user_location->nombre."-".$this->user_location->id);
	}else if($location_cookie){
		$temp = explode('-',$location_cookie);
		$this->user_location = new stdClass();
		$this->user_location->nombre = $temp[0];
		$this->user_location->id = $temp[1];
	}else{
		$this->user_location = new entidad(rand(1,32));
		$this->user_location->read('nombre,id');
	}

    }

    /**
    * Funcion Protegida load_compara_cookie.
    * Lee la cookie 'escuelas' la cual si tiene algún valor la guarda este en el atributo 'compara_cookie' si no pone un valor de false al mismo.
	*/
    protected function load_compara_cookie(){
    	
    	$this->compara_cookie = false;
    	if($this->cookie('escuelas')){
    		$this->compara_cookie = explode('-',$this->cookie('escuelas'));
    		$this->compara_cookie = count($this->compara_cookie) ? $this->compara_cookie : false;
    	}
    }
    
    /**
    * Funcion Protegida cct_count_entidad.
    * Lee de la tabla entidades cuantas escuelas hay del mismo nivel tanto nacional como por entidad y las guarda en los atributos
    * 'nacional_cct_count' y 'entidad_cct_count' respectivamente.
	*/
    protected function cct_count_entidad(){
    	if(isset($this->escuelas)){
		
		foreach($this->escuelas as $escuela){
			$id_entidad = isset($escuela->entidad->id)?$escuela->entidad->id:$escuela->entidad;
			$entidad = new entidad($id_entidad);
			$nivelNombre = isset($escuela->nivel->nombre)?$escuela->nivel->nombre:$escuela->nom_nivel;
			$nivel = "numero_escuelas_".strtolower($nivelNombre);
			$nivelNacional = "numero_nacional_escuelas_".strtolower($nivelNombre);
			$entidad->read($nivel.",".$nivelNacional);
			$escuela->entidad_cct_count = $entidad->$nivel;
			$escuela->nacional_cct_count = $entidad->$nivelNacional;
		}
	}
    }

    /**
    * Funcion Publica load_estado_petitions
    * Obtiene las peticiones que se encuentran en http://www.change.org/ del usuario mejora_tu_escuela y regresa un arreglo con
    * las peticiones que contengan en el titulo el valor del parámetro $estado.
    * \param $estado string
	*/
    public function load_estado_petitions($estado){
    		$estado = $this->get('estado_petition')?$this->get('estado_petition'):$estado;
		date_default_timezone_set('America/Mexico_City');
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$petition_info = $change->regresa_info_peticiones_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela');
		$petition_data = array();
		$i=0;
		foreach($petition_info as $petition){
			$regExp = "/".$estado."/i";
			if(preg_match($regExp, $petition['title'])){
				$petition_data[] = $petition;
				$petition_data[count($petition_data)-1]['count'] = ++$i;
			}else
				$i++;
		}
		if($this->get('estado_petition'))
			echo  json_encode($petition_data);
		else
			return $petition_data;	
    }

    /**
    * Funcion Protegida set_info_user_search
    * Guarda en la tabla user_search un campo con los valores ingresados al momento de realizar una búsqueda donde
    * el parámetro $escuelas_num es la cantidad de resultados que devolvió esa búsqueda.
    * \param $escuelas_num es la cantidad de resultados devueltos
	*/
    protected function set_info_user_search($escuelas_num){
    		
		$params= array();
		if($this->get('search')){
		    $params[] = $this->get('term')?$this->get('term'):"";
			$params[] = $this->get('control')?$this->get('control'):0;
			$params[] = $this->get('nivel')?$this->get('nivel'):0;
			$params[] = $this->get('entidad')?$this->get('entidad'):0;
			$params[] = $this->get('municipio')?$this->get('municipio'):0;
			$params[] = $this->get('localidad')?$this->get('localidad'):0;
		}else if($this->post('search')){
		    $params[] = $this->post('term')?$this->post('term'):"";
			$params[] = $this->post('control')?$this->post('control'):0;
			$params[] = $this->post('nivel')?$this->post('nivel'):0;
			$params[] = $this->post('entidad')?$this->post('entidad'):0;
			$params[] = $this->post('municipio')?$this->post('municipio'):0;
			$params[] = $this->post('localidad')?$this->post('localidad'):0;		
		}
		if(!$this->get('p') && ($this->get('search') || $this->post('search'))){
			$params[] = $escuelas_num;
			$params[] = $_SERVER['HTTP_USER_AGENT'];
			$params[] = $_SERVER['REMOTE_ADDR'];
			$params[] = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
			$user_search = new user_search();
			//$user_search->debug = true;
			$user_search->create(
				'term,control,nivel,entidad,municipio,localidad,cct_count,useragent,remote_addr,http_x_forwarded_for',$params
			);
		}	
    }

    /**
    * Funcion Publica shorten_url.
    * Regresa la url generada por http://ow.ly/url/shorten-url.
    * \param $url string 
	*/
    public function shorten_url($url){
    		$url = $this->get('url')?$this->get('url'):$url;
		$hootSuite = new ApiHootSuite($this->config->hootSuite_api_key);
		$shortUrl = $hootSuite->shorten($url);
		if($this->get('url')){
			if(strpos($this->get('url'),$this->config->http_address)!==False)
				echo  json_encode($shortUrl['results']['shortUrl']);
		}else
			return $shortUrl['results']['shortUrl'];
    
    }

    /**
    * Funcion Publica get_captcha.
    * Regresa un captcha usando el api http://www.google.com/recaptcha  
	*/
    public function get_captcha(){
    		
		//$captcha = new Recaptcha($this->config->recaptcha_public_key,$this->config->recaptcha_private_key);
		//return $captcha->form();


		$sweetcaptcha = new sweetcaptcha(
		  $this->config->SWEETCAPTCHA_APP_ID, 
		  $this->config->SWEETCAPTCHA_KEY, 
		  $this->config->SWEETCAPTCHA_SECRET, 
		  $this->config->SWEETCAPTCHA_PUBLIC_URL
		);

		echo $sweetcaptcha->get_html();
		
    }
    public function mongo_connect(){
    	try{
    		//{$this->config->mongo_user}@
    		$m = new MongoClient("mongodb://{$this->config->mongo_server}:27017/mte_produccion");
    		return $m;
    	}catch(Exception $e){
    		//$e->getMessage();
    		return false;
    	}
    }
    protected function load_programas(){
    	$q = new programa();
    	$q->search_clause =  'federal = "1"';
    	$this->programas_federales = $q->read('id,nombre,m_collection');
    	$q->search_clause = 'federal = "0"';
    	$this->programas_osc = $q->read('id,nombre,m_collection');
    }
    public function get_data_compara_float(){
	if(!$this->request('json')){
		$this->load_compara_cookie();
		$cookie = explode('-',$this->cookie('escuelas_vistas'));
	    	if($this->get('controler') == 'escuelas'){
			$cookie[] = $this->get('id');
		}else if($this->get('controler') == 'compara' && $this->get('action')=='escuelas'){
			$forGet = explode('-',$this->get('id'));
			//$forGet = array_merge($this->compara_cookie,$forGet);
			$this->compara_cookie = array_unique($forGet);
			$this->set_cookie('escuelas',implode("-",$this->compara_cookie));	
		}
		//$this->load_compara_cookie();
		$params = new stdClass();
		if($this->compara_cookie){
			$params->ccts = $this->compara_cookie;
			$this->get_escuelas($params);
			//$this->escuelas

		}
		$this->school_to_compare = isset($this->escuelas)?$this->escuelas:array();
		$this->school_view = array();
		$compare_cookie = $this->compara_cookie?$this->compara_cookie:array();
		if($cookie){
			//no en ambos;
			for($i=count($cookie)-1;$i>=0;$i--){
				if(in_array($cookie[$i],$compare_cookie)){
					unset($cookie[$i]);
				}
			}
			$cookie = array_values($cookie);
			if(count($cookie)){
				$params->ccts = $cookie;
				$this->get_escuelas($params);
				$this->school_view = $this->escuelas?$this->escuelas:array();	
			}
	
		}
	}
    }

    public function send_email($to,$subject,$message,$from,$from_name,$attachment_path = false, $attachment_name = false, $logo_path = false, $logo_name = false, $isHtml = true){
		$url = 'http://sendgrid.com/';
		$params = array(
		    'api_user'  => $this->config->send_grid_user,
		    'api_key'   => $this->config->send_grid_key,
		    'to'        => $to,
			'subject'   => $subject,
			'html'      => $message,
		    //'text'      => '',
		    'from'      => $from
		  );


		$request =  $url.'api/mail.send.json';

		$session = curl_init($request);
		curl_setopt ($session, CURLOPT_POST, true);
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		
		$response = json_decode(curl_exec($session));
		curl_close($session);
		var_dump($response);
		if($response->message!="success"){
			$response = parent::send_email($to,$subject,$message,$from,$from_name);
		}
		return $response;
	}

	public function set_banners(){
	    	$banners = array("FACEBOOK.jpg"=>array("home","https://www.facebook.com/MejoraTuEscuela"),"mejora2.jpg"=>array("mejora","http://blog.mejoratuescuela.org/?s=lectura"),"mejora4.jpg" => array("mejora","http://blog.mejoratuescuela.org/en-que-te-debes-fijar-de-la-infraestructura-de-la-escuela/"),"mejora1.jpg"=>array("mejora","http://blog.mejoratuescuela.org/?s=programa+apoyo"), "mejora3.jpg"=>array("mejora","http://blog.mejoratuescuela.org/?s=bullying"),"sienlace.png"=>array("home","http://www.mejoratuescuela.org/peticiones/sienlace"));
		$pBanner = new page_banner();
		$pBanner->search_clause = " 1";
		$pBanners = $pBanner->read('pagina,banner=>imagen');
		$pages = array();
		$imgs = array();
		if($pBanners!=NULL)
			foreach($pBanners as $b){
				$pages[] = $b->pagina;
				$imgs[] = $b->banner->imagen;
			}
		foreach($banners as $banner_name=>$pageA){
			$page = $pageA[0];
			$url = $pageA[1];
			$insert = true;
			if(!in_array($banner_name,$imgs)){
				$banner = new banner();
				$banner->debug = false;
				$banner->create('imagen,url',array($banner_name,$url));
				$insert = true;
				//
				$id = $banner->id;
			}else{
				$b = new page_banner();
			    	$b->search_clause = "pagina = '$page' "; 
				$bs = $b->read('pagina,banner=>imagen');
				if($bs!=NULL){
					foreach($bs as $b){
						if($b->pagina==$page && $b->banner->imagen==$banner_name){
							$insert = false;
							break;
						}
				
					}
				}
				if($insert){
					$banner = new banner();
					$banner->search_clause = " imagen ='$banner_name'";
					$banner = $banner->read('id');
					$id = $banner[0]->id;		
				}	
			}
			if($insert){
				$pBanner = new page_banner();
				$pBanner->create('pagina,banner',array($page,$id));
			}
		}
	    }

	    public function get_banners(){
	    	$page = $this->location;
		$b = new page_banner();
		$b->search_clause = "pagina = '$page' "; 
		$bs = $b->read('pagina,banner=>imagen,banner=>url');
		$imgs = array();
		if($bs!=NULL)
			foreach($bs as $b){
				$imgs[$b->banner->imagen] = $b->banner->url;
			}
		return $imgs;
    }
}
?>
