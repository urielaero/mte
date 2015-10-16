<?php
	
class api extends main{

	public function api($config){
		$this->config = $config; 
		$this->conn = $this->dbConnect(); 
		$this->serializeAngular();
	}

	public function localidades(){
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

		if($this->request('term') && $this->request('solr') && isset($this->config->solr_server)){
			//var_dump("solr");
			$params->term = $this->request('term');
			$p = $this->request('p')?$this->request('p'):1;
			$this->get_escuelas_new($params,$p);
			$res = array('escuelas' => $this->escuelas);
			echo json_encode($res);
			return;
		}

		if($this->request('sort') == 'Semáforo educativo')
			$params->order_by = ' COALESCE(escuelas_para_rankeo.rank_entidad,(select max(id)+1 from escuelas)), escuelas_para_rankeo.rank_entidad ASC, escuelas_para_rankeo.promedio_general DESC';
		else if($this->request('sort') == 'Promedio general')
			$params->order_by = 'escuelas_para_rankeo.promedio_general DESC';
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
		$headers = getallheaders();
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
		$this->escuela = new escuela($cct, $this->conn);
		$this->escuela->key = 'cct';
		$this->escuela->cct = $cct;
		$this->escuela->fields['cct'] = $cct;
		$this->escuela->read("id,cct");
		header('Access-Control-Allow-Origin: *'); 
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 

		$json = array('error' => 'notFound');
		if($this->escuela->id != $this->escuela->cct){
	            	if($this->escuela->setEducAccion($this->mongo_connect())){
				$json = array('status'=>'ok', 'cct' => $cct);
			}	
		}
		//$this->sendEmailSuscribeEducacion($email, 'mamasypapaseneducaccion@fundaciontelevisa.org');
		$this->sendEmailSuscribeEducacion($email, '120300051@ucaribe.edu.mx');
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
}
?>
