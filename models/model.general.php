<?php
class cp extends table{
	function info(){
		$this->table_name = "cps";
	}
}
class state extends table{
	function info(){
		$this->table_name = "entidades";
	}
}
class municipio extends table{
	function info(){
		$this->table_name = "municipios";
	}	

}
class localidad extends table{
	function info(){
		$this->table_name = "localidades";
	}

}
class senator extends table{
	function info(){
		$this->table_name = "senadores";
	}
}
class escuela extends table{
	function info(){
		$this->table_name = "escuelas";
	}

}
class nivel extends table{
	function info(){
		$this->table_name = "niveles";
	}
}
class status extends table{
	function info(){
		$this->table_name = "statuses";

	}

}
?>