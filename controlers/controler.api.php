<?php
	/** 
	* Clase Principal main.
	* Clase que hereda las utilidades necesarias para conectar los controladores
	* Contiene métodos y atributos que podrán ser usados por todos los controladores.
	*/
class api extends main{
	/** 
	* Constructor de la Clase main.
	* Realiza la conexión con la base de datos y deja disponible variables que se usaran en todas los controladores
	* Constructor main recive el parametro $config
	* \param $config 
	*/

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
		if(isset($headers['Content-Type']) && $headers['Content-Type'] == 'application/json;charset=UTF-8'){
			$data = json_decode(file_get_contents("php://input"));
			foreach($data as $key => $val){
				if($key == 'p') $_REQUEST[$key] = $val;
				else $_POST[$key] = $val;
			}
			$_POST['json'] = true;
			return $data;
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
