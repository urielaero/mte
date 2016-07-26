<?php
class api_ventanilla_escolar extends main{
    public function api_ventanilla_escolar($config){
        $this->config = $config; 
        $this->conn = $this->dbConnect(); 
    }

    private function resJson($data) {
        header('Access-Control-Allow-Origin: *'); 
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 
        echo json_encode($data);
    }

    public function notifies_available() {
        $email = $this->request('email');
        $entity = $this->request('entity');
        $cct = $this->request('cct');
        $notify = new ventanilla_pendientes(NULL, $this->conn);   
        $notify->create('email, entidad, cct', array($email, $entity, $cct));
        $this->resJson(array("success"=>true));
    }

    public function supervisor() {
        //for cct_zona, search school = 21EES0317Z;
    	$cct = $this->request('cct');
        $escuela = new escuelas_2013($cct, $this->conn); 
        $escuela->read("clavecct,cct_zona,entidad,nivel,zonaescola");
        $supervisor = new supervisor(NULL, $this->conn);
        $supervisor->search_clause = '';
        $res = array("supervisor" => false);
        if (isset($escuela->cct_zona) && $escuela->cct_zona != NULL ) {
            $supervisor->search_clause = "cct='{$escuela->cct_zona}' OR";
            $res["cct_zona"] = $escuela->cct_zona;
        }
        if ($escuela->zonaescola != NULL ) {
            $zona = intval($escuela->zonaescola);
            $supervisor->search_clause .= " (entidad={$escuela->entidad} AND nivel={$escuela->nivel} AND zona={$zona})";
        }
        if ($supervisor->search_clause == '') {
            return $this->resJson($res);
        }
        $supervisor->limit = 1; 
        $find = $supervisor->read('cct,nombrect,domicilio,colonia,localidad,municipio,codigo_postal,telefono,nombre');
        if ($find && count($find)) {
            $res["supervisor"] = true;
            $superv = $find[0];
            $res["nombrect"] = $superv->nombrect;
            $res["nombre"] = $superv->nombre;
            $res["domicilio"] = $superv->domicilio;
            $res["colonia"] = $superv->colonia;
            $res["localidad"] = $superv->localidad;
            $res["municipio"] = $superv->municipio;
            $res["codigo_postal"] = $superv->codigo_postal;
            $res["telefono"] = $superv->telefono;
        }
        $this->resJson($res);
    }

    public function dif() {
        //21EBH0386S;
    	$cct = $this->request('cct');
        $escuela = new escuelas_2013($cct, $this->conn); 
        $escuela->read("clavecct,municipio,entidad");
        $dif = new dif_municipio(NULL, $this->conn);
        $dif->search_clause = "clave_municipio={$escuela->municipio} AND entidad={$escuela->entidad}";
        $dif->limit = 1;
        $find = $dif->read('municipio_nombre,domicilio,telefono,horario,email,encargado'); 
        $res = array('dif' => false);
        if ($find && count($find)) { 
            $d = $find[0];
            $res['dif'] = true;
            $res['municipio_nombre'] = $d->municipio_nombre;
            $res['domicilio'] = $d->domicilio;
            $res['telefono'] = $d->telefono;
            $res['horario'] = $d->horario;
            $res['email'] = $d->email;
            $res['encargado'] = $d->encargado;
        }
        $this->resJson($res);
    }
}
?>
