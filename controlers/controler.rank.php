<?php

/*
* Clase busqueda Extiende main.
*/
class busqueda extends main{


	public function index(){
		
	}

	/*
	* Funcion Publica rank_entidades.
	*/
	public function rank_entidades(){
		exit('controles-rank');
		$escuela = new escuela(NULL, $this->conn);
		$entidades = range(1,32);
		$niveles = array(12,13,22);
		foreach($niveles as $nivel){
			foreach($entidades as $entidad){
				$result = $escuela->rank($nivel,$entidad);
			}
		}
	}

	/*
	* Funcion Publica rank_municipios.
	*/
	public function rank_municipios(){
		$escuela = new escuela(NULL, $this->conn);
		$q = new municipio();
		$q->search_clause = "1";
		$municipios = $q->read('id,nombre');
		$niveles = array(12,13,22);
		foreach($niveles as $nivel){
			foreach($municipios as $municipio){
				$escuela->rank($nivel,false,$municipio->id);
			}
		}
	}
}
?>
