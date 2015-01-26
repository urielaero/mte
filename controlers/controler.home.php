<?php

/**
* Clase home Extiende main.
* Controlador: /home
*/
class home extends main{
	
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/*$this->load_niveles();
		$this->load_entidades();
		$this->load_municipios();
		$this->load_localidades();*/
		$this->load_escuelas();//OJO carga el top5
		$this->get_metadata();
		if(!$this->cookie('user_location'))
			$this->draw_map = true;
		$this->include_theme('index','index');
	}

	/**
	*Funcion Publica load_escuelas.
	* Lee de la tabla escuelas las 5 primeras en un determinado nivel. El nivel es elegido de manera aleatoria entre: primaria (12)
	* secundara (13)  o bachillerato (22). El estado al que pertenecen las escuelas se determina por IP.
	*/
	public function load_escuelas(){
		$niveles = array(12,13,22);
		$this->get_location();
		//$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC';
		$params = new stdClass();
		
		$params->order_by = ' COALESCE(escuelas_para_rankeo.rank_entidad,(select max(id)+1 from escuelas)), escuelas_para_rankeo.rank_entidad ASC';
		$this->nivel_5 = $params->nivel = $niveles[rand(0,2)];
		$params->entidad = $this->user_location->id;
		$params->limit = '5 OFFSET 0';
		//$this->debug = true;
		$this->get_escuelas($params);
		$this->process_escuelas();
	}

	/**
	* Funcion Publica twitter.
	* Crea las peticiones que se harán al API de twitter con autenticación y los resultados son presentados en formato JSON.
	*/
	public function twitter(){
		$params = array('oauth_access_token'=>$this->config->twitter_access_token,
			'oauth_access_token_secret'=>$this->config->twitter_access_token_secret,
			'consumer_key'=>$this->config->twitter_consumer_key,
			'consumer_secret'=>$this->config->twitter_consumer_secret,
			'use_whitelist' => false,
			'base_url' => 'https://api.twitter.com/1.1/'
		);
		$this->add_component("twitter_component",$params);
	    $this->components['twitter_component']->twitterToken('mejoratuescuela',10,'mejoratuescuela');
	   }

	/**
	* Funcion Publica get_abreviatura_estado.
	* Recibe como parámetro el estado si encuentra abreviatura para este lo regresa sí no el valor del parámetro pasado es devuelto.
	* \param $estado arreglo string
	*/
	public function get_abreviatura_estado($estado){
    		$estado = strtolower($estado);
		$estados["aguascalientes"] = "Ags.";
		$estados["baja california"] = "B.C.";
		$estados["baja california sur"] = "B.C.S.";
		$estados["campeche"] = "Camp.";
		$estados["chiapas"] = "Chis.";
		$estados["chihuahua"] = "Chih.";
		$estados["coahuila"] =  "Coah.";
		$estados["colima"] = "Col.";
		$estados["distrito federal"] = 	"D.F.";
		$estados["durango"] = "Dgo.";
		$estados["guanajuato"] = "Gto.";
		$estados["guerrero"] = "Gro.";
		$estados["hidalgo"] = "Hgo.";
		$estados["jalisco"] = "Jal.";
		$estados["méxico"] = "Méx.";
		$estados["michoacán"] = "Mich.";
		$estados["morelos"] = "Mor.";
		$estados["nayarit"] = "Nay.";
		$estados["nuevo león"] ="N.L.";
		$estados["oaxaca"] = "Oax.";
		$estados["puebla"] = "Pue.";
		$estados["querétaro"] = "Qro.";
		$estados["quintana roo"] = "Q. Roo.";
		$estados["san luis potosí"] = 	"S.L.P";
		$estados["sinaloa"] = "Sin.";
		$estados["sonora"] = "Son.";
		$estados["tabasco"] = "Tab.";
		$estados["tamaulipas"] = "Tamps.";
		$estados["tlaxcala"] = "Tlax.";
		$estados["veracruz"] = "Ver.";
		$estados["yucatán"] = "Yuc.";
		$estados["zacatecas"] = "Zac.";
		if(isset($estados[$estado]))
			return $estados[$estado];
		else
			return $estado;
    	
	}

	/**
	* Funcion Publica newletter.
	* Guarda en la tabla newsletters la información del usuario que desea registrarse a través del formulario en el home
	* "Mantente informado" y notifica a este si fue o no registrado correctamente.
	*/
	public function newsletter(){
		$location = "/home/";
		if($this->post('aviso')){
			$correo = $this->post('correo');
			$news = new newsletters(NULL,$this->conn);
			$news->debug = true;
			$news->create('email_input',array($correo),'id');
			$location = $news->id ? "/home/index?news=true" : "/home/index?news=false";
		}
		$this->send_email(
			$correo,
			'Mejora tu escuela',
			'Ha sido registrado correctamente en http://www.mejoratuescuela.org',
			'contacto@mejoratuescuela.org',
			'www.mejoratuescuela.org'
		);
		
		//include_once $_SERVER['DOCUMENT_ROOT'].'/library/SendGrid_loader.php';

		//$sendgrid = new SendGrid('***REMOVED***', '***REMOVED***');
		//var_dump($_SERVER['DOCUMENT_ROOT'].'/library/SendGrid_loader.php', $sendgrid);exit();
		//exit;
		header("location: $location");
	}

	/**
	* Funcion Publica get_metadata.
	*Contiene los datos a mostrar en el meta tag description a las vistas que pertenezcan a este controlador
	*/
	public function get_metadata(){
		$this->meta_description = "Encuentra los mejores preescolares, primarias, secundarias y bachilleratos públicos y privados en tu zona. Consulta información de la infraestructura disponible en el plantel y revisa qué dicen otros padres sobre los maestros, el nivel y las instalaciones de cada escuela. Encuentra bibliotecas cercanas a tu escuela o tu casa.";
	}

	public function get_top5(){
		$niveles = array(12,13,22);
		$params = new stdClass();
		$this->nivel_5 = $params->nivel = $niveles[rand(0,2)];
		$name_entidad = $this->request('name_entidad');
		$params->order_by = ' COALESCE(escuelas_para_rankeo.rank_entidad,(select max(id)+1 from escuelas)), escuelas_para_rankeo.rank_entidad ASC';
		$entidad = new entidad(NULL,$this->conn);
		$entidad->search_clause = " LOWER(entidades.nombre) = LOWER('$name_entidad')";
		//TODO: pg_query falla con comillas dobles!

		$en = $entidad->read('id,nombre');
		$params->entidad = $en[0]->id;
		$name_entidad = $en[0]->nombre;

		if(!$params->entidad){
			$this->get_location();
			$params->entidad = $this->user_location->id;
			$name_entidad = $this->user_location->nombre;
		}
		$params->limit = '5 OFFSET 0';
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->set_cookie('user_location',$name_entidad."-".$params->entidad);
		$this->user_location->nombre = $this->capitalize($name_entidad);
		$this->include_template("top5","home/single"); 
	}

	public function e404(){
		$this->header_folder = '';
		$this->include_theme('index','e404');
	}

}
?>
