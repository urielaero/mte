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

	public function escuelas(){
		//var_dump($this->request('niveles'));
		$params = new stdClass();
//<<<<<<< HEAD
//		$params->order_by = ' COALESCE(escuelas_para_rankeo.rank_entidad,1), escuelas_para_rankeo.rank_entidad ASC, escuelas_para_rankeo.promedio_general DESC';
//=======
		if($this->request('sort') == 'Semáforo educativo')
			$params->order_by = ' COALESCE(escuelas_para_rankeo.rank_entidad,1), escuelas_para_rankeo.rank_entidad ASC, escuelas_para_rankeo.promedio_general DESC';
//>>>>>>> 58ace7c9f81e4c6a68f10703570775100291f7c3
		$params->pagination = 6;
		$this->get_escuelas($params);
		$this->process_escuelas();
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

}
?>
