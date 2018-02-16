<?php
class kaluz_escuela extends table{
	function info(){
        $this->key = 'id';
		$this->table_name = "kaluz_escuelas";
		$this->objects['entidad'] = 'entidad';
		$this->objects['turno'] = 'turno';
		$this->objects['kaluz_tipo_dano'] = 'kaluz_tipo_dano';
		$this->objects['kaluz_estatus_reconstruccion'] = 'kaluz_estatus_reconstruccion';

		$this->has_many['kaluz_escuela_organizacion'] = 'kaluz_escuela_organizacion';
		$this->has_many_keys['kaluz_escuela_organizacion'] = 'kaluz_escuela';

	}
}

class kaluz_estatus_reconstruccion extends table{
	function info(){
		$this->table_name = "kaluz_estatus_reconstrucciones";
	}
}

class kaluz_tipo_dano extends table{
	function info(){
		$this->table_name = "kaluz_tipo_danos";
	}
}

class kaluz_escuela_organizacion extends table{
    function info() {
        $this->table_name = "kaluz_escuela_organizacion";
    }

    function organizacion($conn) {
        $org = new kaluz_organizaciones($this->kaluz_organizacion, $conn);
        $org->read("id,nombre");
        return array("id" => $org->id, "nombre" => $org->nombre, "link" => "/");
    }
}

class kaluz_organizaciones extends table {
    function info() {
        $this->table_name = "kaluz_organizaciones";
    }
}

?>
