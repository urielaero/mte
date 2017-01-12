<?php
	
class api extends main{

	public function api($config){
		$this->config = $config; 
		$this->conn = $this->dbConnect(); 
		$this->serializeAngular();
	}

	public function localidades(){
		header("Access-Control-Allow-Origin: *"); 
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
		$json = $this->load_localidades();
		echo json_encode($json);
	}

    public function subscribe(){
        $res = $this->newsletter(true);
        $json = array('status'=>$res);
	header("Access-Control-Allow-Origin: *"); 
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
		echo json_encode($json);
    }

	public function escuelas(){
		//$this->debug = true;
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		$params = new stdClass();



		if(($this->request('term') || $this->request('oneCCT')) && $this->request('solr') && isset($this->config->solr_server)){
			//var_dump("solr");
			$params->term = $this->request('term');
			$params->cct = $this->request('oneCCT');
			$p = $this->request('p')?$this->request('p'):1;
			$this->get_escuelas_new($params,$p);
			$res = array('escuelas' => $this->escuelas);
			echo json_encode($res);
			return;
		}

		if ($this->request('term_like')) {
			$params->term_text = $this->request('term_like');
		}

		$type_test = $this->request("type_test");
		if (!$type_test || $type_test == "planea") {
			$params->type_test = "planea";
		} else {
			$params->type_test = "enlace";
		}

		$sort = $this->request('sort');

		if($sort == 'Semáforo educativo') {
			if ($params->type_test == "enlace")
				$params->order_by = ' COALESCE(escuelas_para_rankeo.rank_entidad,(select max(id)+1 from escuelas)), escuelas_para_rankeo.rank_entidad ASC, escuelas_para_rankeo.promedio_general DESC';
			else {
				$params->order_by = 'planea_escuelas.clave_semaforo ASC';
			}
		}
		else if($sort == 'Promedio general' && $params->type_test == "enlace"){
			$params->order_by = 'escuelas_para_rankeo.promedio_general DESC';
		}else if($sort == 'Nombre de la escuela') {
			$params->order_by = "escuelas.nombre ASC";
		}else{ 
			$params->order_by = 'planea_escuelas.score_global DESC';
		}

		if($this->request('ccts')) $params->ccts = explode(',',$this->request('ccts')); 
		if($this->request('pagination')) 
			$params->pagination = $this->request('pagination');
		else
			$params->pagination = 6;
		if($this->request('limit')) $params->limit = $this->request('limit');
		$this->get_escuelas($params);
		if($this->request('cct_count_entidad')) $this->cct_count_entidad();
		$this->process_escuelas($this->request('detail'));
		$this->escuelas_digest->pagination = $this->pagination;
		$this->escuelas_digest->pagination->conn = NULL;

		echo json_encode($this->escuelas_digest);
	}
	public function serializeAngular(){
		$headers = array();
		if (function_exists('getallheaders')) {
			$headers = getallheaders();
		}
		if(isset($headers['Content-Type'])){
			$ctype = explode(';',$headers['Content-Type']);
			if($ctype[0] == 'application/json'){
				$data = json_decode(file_get_contents("php://input"));
				foreach($data as $key => $val){
					if($key == 'p') $_REQUEST[$key] = $val;
					else $_POST[$key] = $val;
				}
				$_POST['json'] = true;
				return $data;
			}else return false;
		}else{
			return false;
		}
		
	}

	// Realmente lo que hace esta funcion es acotar los objetos para solo incluir especificacion especificada, 
	// con la limitante de solo tener 1 nivel de profundidad
	public function jsonify($objects,$fields){
		$json = [];
		foreach($objects as $object){
			$obj =  new stdClass();
			foreach($fields as $field){
				$obj->$field = $object->$field;
			}
			$json[] = $obj;			
		}
		return $json;
	}

	public function suscribeEducacion(){
		//update mongoinfo 
		$cct = $this->request('cct');
		$email = $this->request('email');
		$year = $this->request('year') ? $this->request('year') : 2015;
		$this->escuela = new escuela($cct, $this->conn);
		$this->escuela->key = 'cct';
		$this->escuela->cct = $cct;
		$this->escuela->fields['cct'] = $cct;
		$this->escuela->read("id,cct");
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 

		$json = array('error' => 'notFound');
		if($this->escuela->id != $this->escuela->cct){
	            	if($this->escuela->setEducAccion($this->mongo_connect(), $year)){
				$json = array('status'=>'ok', 'cct' => $cct);
			}	
		}
		$this->sendEmailSuscribeEducacion($email, 'mamasypapaseneducaccion@fundaciontelevisa.org');
		echo json_encode($json);
    	}

	private function sendEmailSuscribeEducacion($email,$from){
		$res = $this->send_email(
			$email, //to
			'Gracias por tu registro', //sub
			$this->config->email_convocatoria,//msg
			$from, //from
			'mamasypapaseneducaccion' //fromname
		);

		$res = $this->send_email(
			$from, //to
			'Gracias por tu registro (reply)', //sub
			$this->config->email_convocatoria,//msg
			$email, //from
			$email //fromname
		);

		return $res;
	}

	/*Api tuberia de denuncias*/

	private function sendPublicHeadersAndResponse($data){
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 
		echo json_encode($data);
	}

	/*Denuncias*/

	public function create_denuncia(){
		$data = $this->request("data");
		$req = json_decode($data, true);
		$denuncia = array("error" => "email required");
		if($req && isset($req["email"])){
			if (!$req["entidadId"])
				$req["entidadId"] = $this->get_entidad_id($req["cct"]);
			$tuberia = new tuberia_denuncia($this->mongo_connect());
            $ventanill_denuncia = new ventanilla_denuncia(null, $this->conn);
            $ventanill_denuncia->create('tipo,cct,entidad,nivelnombre,email,nombre,ocupacion', array(
                   $req['label'],
                   $req['cct'],
                   $req['entidadId'],
                   $req['nivelName'],
                   $req['email'],
                   $req['userName'],
                   $req['userOccupation']
                ), 'id');
            $req["denuncia"] = $ventanill_denuncia->id;
			$denuncia = $tuberia->save($req);
			if($denuncia){
				$denuncia["success"] = true;
			}else{
				$denuncia = array("error" => "no save");
			}
		}

		$this->sendPublicHeadersAndResponse($denuncia);

	}

	public function update_denuncia(){
		$data = $this->request("data");
		$req = json_decode($data, true);
		$denuncia = array("error" => "no token");
		if(isset($req["token"])){
            $den = $this->update_history($req);
			$tuberia = new tuberia_denuncia($this->mongo_connect());
			$denuncia = $tuberia->update($den);
			if($denuncia){
				$denuncia["success"] = true;
			}else{
				$denuncia = array("error" => "token not found");
			}	
		}
		$this->sendPublicHeadersAndResponse($denuncia);
		
	}

    public function update_history($denuncia) {
        foreach($denuncia['history'] as &$history) {
            if ($history['answer']) { 
                $aws = new ventanilla_respuesta($history['answer'], $this->conn);
            } else {
                $aws = new ventanilla_respuesta(null, $this->conn);
                $aws->create('denuncia', array($denuncia['denuncia']), 'id');
                $history['answer'] = $aws->id;
            }
            $resp = array_key_exists('text', $history['select']) ? $history['select']['text'] : '';
            $resp = substr($resp, 0 , 199);
            $step = array_key_exists('stepId', $history) ? $history['stepId'] : -1;
            $aws->update('numero,respuesta,step', array(intval($history['number']), $resp, floatval($step)));
        }
        return $denuncia;
    }

	public function read_denuncia(){
		$data = $this->request("data");
		$req = json_decode($data, true);
		$denuncia = array("error" => "no token");
		if(isset($req["token"])){
			$tuberia = new tuberia_denuncia($this->mongo_connect());
			$denuncia = $tuberia->findByToken($req["token"]);
			if(!$denuncia){
				$denuncia = array("error" => "token not found");
			}
		}
		$this->sendPublicHeadersAndResponse($denuncia);
	}

	public function export_denuncias(){
		$data = $this->request("data");
		$req = json_decode($data, true);
		$email = $req["email"];
		if($email){
			$tuberia = new tuberia_denuncia($this->mongo_connect());
			$denuncias = $tuberia->findByEmail($email);
			$denunciasLen = count($denuncias);
			$res = array("success" => true, "total" => $denunciasLen);
			$this->sendPublicHeadersAndResponse($res);
			if($denunciasLen)
				$this->send_denuncias($email, $denuncias);
		}else{
			$this->sendPublicHeadersAndResponse(array("error" => "email not found"));
		}
	}

	private function send_denuncias($email, $denuncias){
		$html = "<p>Hola <br> Haz click en el siguiente enlace para continuar con tu reporte:</p>";
		$urlBase = $this->config->ventanilla_front_url;
		foreach($denuncias as $i => $den){
			$index = $i + 1;
			$type = $this->capitalize($den["label"]);
			$date = $this->format_date($den["startDate"]);
			$cct = $den["cct"];
			$name = $this->get_school_name($cct);
			$html.=" <p>
					$type, $date, $name ($cct). Editar:
					<a href='{$urlBase}{$den["token"]}'>{$urlBase}{$den["token"]} </a> <br/> <br/>
				</p>
			";
		}

		$html .= "<br> Saludos cordiales, <br>Equipo de Ventanilla Escolar";
		$res = $this->send_email(
			$email, //to
			"Continúa con tu reporte de Ventanilla Escolar", //sub
			$html,//msg
			"system@mejoratuescuela.org", //from
			"Mejora tu escuela" //fromname
		);
		return $res;
	}

	public function send_email_contacto(){
		$this->send_email(
			$this->config->contact_email,
			'Correo electrónico desde Ventanilla Escolar de: '.$this->request('email'),
			$this->request('mensaje'),
			'system@mejoratuescuela.org',
			$this->request('nombre'));
		$this->sendPublicHeadersAndResponse(array('success' => true));
	}

	private function get_entidad_id($cct){
		$escuela = new escuela($cct, $this->conn);
		$escuela->key = 'cct';
		$escuela->cct = $cct;
		$escuela->fields['cct'] = $cct;
		$escuela->read("id,cct,entidad=>id");
		if (isset($escuela->entidad))
			return $escuela->entidad->id;
		return null;
	}

	public function test(){
		//$res = $this->send_email("aero.uriel@gmail.com", "test from sendgrid", "<p>Hola mundo cruel</p>", "system@mejoratuescuela.org", "mte");
		$email = "aero.uriel@gmail.com";
		$tuberia = new tuberia_denuncia($this->mongo_connect());
		$denuncias = $tuberia->findByEmail($email);
		$res = $this->send_denuncias($email, $denuncias);
		echo $res;
	}

	private function format_date($date){
		$d = date_create($date);
		return date_format($d, 'd-m-Y');
	}

	private function get_school_name($cct){
		$this->escuela = new escuela($cct, $this->conn);
		$this->escuela->key = 'cct';
		$this->escuela->cct = $cct;
		$this->escuela->fields['cct'] = $cct;
		$this->escuela->read("nombre");
		return $this->escuela->nombre;
	}


	public function get_map_info() {
		$prog = new programas($this->config);
		$this->load_entidades();
		$prog->programa_info("45");

		$estados_programa = array();
		foreach ($this->entidades as $key => $estado) {
			if(isset($prog->programa->entidad_escuelas_count[$estado->id]) && $prog->programa->entidad_escuelas_count[$estado->id] > 0){
				$estado->count_participa = $prog->programa->entidad_escuelas_count[$estado->id];
				if (count($prog->programa->entidad_escuelas_count_link)) {
					$estado->count_per_link = $prog->programa->entidad_escuelas_count_link[$estado->id];
				}
				array_push($estados_programa, $estado);
			}
		}

		$this->sendPublicHeadersAndResponse($estados_programa);
	}


}
?>
