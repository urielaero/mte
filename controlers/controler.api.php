<?php
	
class api extends main{

	public function api($config){
		$this->config = $config; 
		$this->dbConnect(); 
		$this->serializeAngular();

	}

	public function localidades(){
		$json = $this->load_localidades();
		echo json_encode($json);
	}

	public function escuelas(){
		//var_dump($this->request('niveles'));
		$params = new stdClass();
		if($this->request('sort') == 'Semáforo educativo')
			$params->order_by = ' ISNULL(escuelas_para_rankeo.rank_entidad), escuelas_para_rankeo.rank_entidad ASC, escuelas_para_rankeo.promedio_general DESC';
		$params->pagination = 6;
		$this->get_escuelas($params);
		$this->process_escuelas();
		$this->escuelas_digest->pagination = $this->pagination;
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
