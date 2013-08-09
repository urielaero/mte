<?php
class peticiones extends main{
	public function index(){		
		$this->read_peticion();
		$this->breadcrumb = array('#'=>'Peticiones');
		$this->header_folder = 'compara';
		$this->title_header = 'PETICIONES';
		$this->include_theme('index','index');
	}
	private function read_peticion(){
		date_default_timezone_set('America/Mexico_City');
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$this->petition_url = array();
		#$this->petition_url[] = 'http://www.change.org/peticiones/autoridades-educativas-del-gobierno-del-estado-de-m%C3%A9xico-exigimos-saber-como-se-gastan-nuestras-cuotas-en-la-escuela-%C3%A1ngel-maria-garibay-kintana';
		#$this->petition_url[] = 'http://www.change.org/peticiones/secretar%C3%ADa-de-educaci%C3%B3n-p%C3%BAblica-inclusi%C3%B3n-del-arte-como-asignatura-obligatoria-en-las-primarias-de-m%C3%A9xico';
		$this->petition_url[] = 'http://www.change.org/peticiones/d%C3%ADa-negro-para-las-mujeres-en-m%C3%A9xico-por-la-declaratoria-de-la-alerta-de-violencia-contra-las-mujeres-en-m%C3%A9xico';
		$this->peticion = array();
		for($i=0;$i<count($this->petition_url);$i++){
			//$this->peticion[] = $change->regresa_info_peticion($this->petition_url[$i]);

		}
	#var_dump($change->regresa_id_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela'));
	//var_dump($change->regresa_info_peticiones_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela'));
		$this->petition_info = $change->regresa_info_peticiones_organizacion('http://www.change.org/organizaciones/mejora_tu_escuela');
	}
	public function firmar(){
		$petition_url = $this->post('petition_url');
		$petition_auth_key = '3d123d2998aa55899a372ac09aef99f166e74c854df7ec877497533ee996103b';

		$names = explode(' ',$this->post('nombre'));
		$name = $names[0];
		unset($names[0]);
		$hidden = $this->post('public') ? 'false' : 'true';
		$last_name = isset($names[1]) ? implode(' ',$names) : '';

		$parameters['source'] = 'www.mejoratuescuela.org/peticiones';
		$parameters['email'] = $this->post('email');
		$parameters['first_name'] = $name;
		$parameters['last_name'] = $last_name;
		$parameters['city'] = $this->post('ciudad');
		$parameters['postal_code'] = $this->post('cp');
		$parameters['country_code'] = $this->post('pais');
		$parameters['hidden'] = $hidden;
		$change = new ApiChange($this->config->change_api_key,$this->config->change_secret_token);
		$this->sign_result = $change->suma_firma_peticion($petition_url,$petition_auth_key,$parameters);
		

		$this->header_folder = 'escuelas';
		$this->read_peticion();
		$this->include_theme('index','index');

	}
}
?>
