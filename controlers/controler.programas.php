<?php

/**
* Clase programas Extiende main.
* Controlador: host/programas
*/
class programas extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->programa_info();
        $this->load_programas();
		$this->title_header = 'Programas';
        $this->page_title = $this->programa->nombre.' | Mejora tu Escuela';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('/mejora/programas/'=>'Programas');
		$this->subtitle_header = '
			MejoraTuEscuela.org es una plataforma que busca <br />
			promover la participación ciudadana para transformar <br />
			la educación en México.';
        $this->header_folder = 'mejora';
        $this->draw_map = true;
		$this->include_theme('index','index');
	}

	private function programa_info(){
		$this->programa = new programa($this->get('id'),$this->conn);
		$this->programa->read("id,nombre,tema,descripcion,zonas,requisitos,direccion,telefono,mail,telefono_contacto,sitio_web,m_collection,tema_especifico");
        $escuelas_count = $this->get_estado_escuelas_count($this->programa->m_collection);
	    $this->programa->entidad_escuelas_count = $escuelas_count[0];
        $this->programa->entidad_escuelas_count_link = $escuelas_count[1];
	}

    public function estado_escuelas(){
        $programa = $this->request('id');
        $estado = $this->request('es');
        $skip = $this->request('skip')?$this->request('skip'):0;
        $estado = str_pad($estado,2,'0',STR_PAD_LEFT);
        $objects = $this->get_estado_escuelascct($programa,$estado,$skip);
        $ccts = array();
        $cctsObjects = array();
        foreach($objects as $ob) {
            $cct = $ob['cct'];
            $ccts[] = $cct;
            $cctsObjects[$cct] = $ob;
        }
        
        $params = new stdClass();
    	if($skip!=0 && !$ccts){
    		exit;
        }
        $params->ccts = $ccts;
        $params->limit = "20 OFFSET 0";
        #$params->order_by = "ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC, escuelas.promedio_general DESC";
        $params->one_turn = true;
        $params->order_by = "escuelas.nombre ASC";
        $params->entidad = $estado;
        $this->get_escuelas($params);
    	$skip +=20;
    	$this->url_more_cct = "id={$programa}&es={$estado}&skip={$skip}";
        if($this->config->theme == 'mtev2'){
            $api = new api($this->config);
            $escuelasJson = $api->jsonify($this->escuelas,["cct","nombre","municipio"]);
            foreach($escuelasJson as $key => $field){
                $escuelasJson[$key]->nombre = $this->capitalize($escuelasJson[$key]->nombre);
                $escuelasJson[$key]->municipio = $this->capitalize($escuelasJson[$key]->municipio->nombre);
                $escuelasJson[$key]->meta = $cctsObjects[$escuelasJson[$key]->cct];
            }
            echo json_encode($escuelasJson);
        }else{
            $this->include_template("estado_escuelas","programas/partial");
        }
    }


    /**
     * requiere m_collection seteado
     * setea escuelas y estado_escuelas
     * */
    protected function get_estado_escuelas_count($m_collection = false){
        $estado_escuelas = array();
        $estado_escuelas_count_custom_link = array();
        if (!$m_collection) return $estado_escuelas;
        try {
            $m = $this->mongo_connect();
            if($m){ 
                $db = $m->selectDB("mte_programas");
                /*if($m_collection == 'siat'){
                    $c = $db->selectCollection("siat");//pec,jornada_amplia,siat,censo_2013    
                    for($i=1;$i<=32;$i++){
                        $estado_escuelas[$i] = $c->count(array("edo" => $i));
                    }
                }else{*/
                    $c = $db->selectCollection("normalizados");//pec,jornada_amplia,siat,censo_2013    
                    $max_aux = $c->find(array("programa" => $m_collection))->sort(array ("anio" => -1))->limit(1);
                    $aux = $max_aux->getNext();

                    $max_anio = isset($aux['anio']) ? $aux['anio'] : false ;

                    $aux_many_years = $c->distinct("anio", array("programa" => $m_collection));

                    $aux_ciclos = $c->distinct('anio', array("ciclo" => true, "programa" => $m_collection));


                    $count_custom_link = array('customLinkText' => array('$exists' => true));

                    for($i=1;$i<=32;$i++) {
                        $aux = $i;
                        if ($i < 10) {
                            $aux = '0'.$i;
                        }
                        if (count($aux_many_years) >= 2 && $aux_many_years[0] && $aux_many_years[1]) {
                            $group = $c->aggregate(array(
                                array('$match' => array('programa' => $m_collection, 'cct' => array('$regex' => '^'.$aux.'.*'))),
                                array('$group' => array('_id' => '$anio', 'count' => array('$sum' => 1))),
                                array('$sort' => array('_id' => -1))
                            ));
                            $result = $group["result"];
                            if (count($result)) {
                                $estado_escuelas[$i] = $group["result"];
                            } else {
                                $estado_escuelas[$i] = 0;
                            }
                        } else if ($max_anio) {
                            $params_mongo = array( "anio" => $max_anio , "cct" => array('$regex' => '^'.$aux.'.*'),"programa" => $m_collection );
                            $estado_escuelas[$i] = $c->count($params_mongo);
                            $estado_escuelas_count_custom_link[$i] = $c->count(array_merge($params_mongo, $count_custom_link));
                        } else {
                            $estado_escuelas[$i] = $c->count(array( "cct" => array('$regex' => '^'.$aux.'.*'),"programa" => $m_collection ));
                        }

                        if (count($aux_ciclos)) {
                            foreach($estado_escuelas[$i] as &$year) {
                                if (in_array(intval($year["_id"]), $aux_ciclos)) {
                                    $year["is_ciclo"] = true;
                                }
                            }
                        }
                    }

                //}
                $m->close();
            }
        } catch(Exception $ex) {
            if ($this->debug) {
                var_dump($ex);
                throw $ex;
            }
        }

        return array($estado_escuelas, $estado_escuelas_count_custom_link);
    }

    protected function get_estado_escuelascct($programa,$estado_id,$skip=0,$limit=20){
        $escuelas = array();
        $this->programa = new programa($programa,$this->conn);
        $this->programa->read("id,m_collection");

        if (!$this->programa->m_collection) return false;
        try {
            $m = $this->mongo_connect();
            $db = $m->selectDB("mte_programas");
            if($this->programa->m_collection == 'siat'){
                $c = $db->selectCollection('siat');//pec,jornada_amplia,siat,censo_2013

                $max_aux = $c->find()->sort(array ("anio" => -1))->limit(1);

                $aux = $max_aux->getNext();
                $max_anio = isset($aux['anio']) ? $aux['anio'] : false ;
                if ($max_anio) {
                    $escuelasaux = $c->find(array( "anio" => $max_anio , "cct" => array('$regex' => '^'.$estado_id.'.*') ))->limit($limit)->skip($skip);
                } else {
                    $escuelasaux = $c->find(array( "cct" => array('$regex' => '^'.$estado_id.'.*') ))->limit($limit)->skip($skip);
                }
                $i = 0;
                while($escuelasaux->hasNext()) {
                    $aux = $escuelasaux->getNext();
                    $escuelas[$i++] = $aux['cct'];
                }
            }else{
                $c = $db->selectCollection('normalizados');
                $max_aux = $c->find(array('programa'=>$this->programa->m_collection))->sort(array ("anio" => -1))->limit(1);

                $aux = $max_aux->getNext();
                $max_anio = isset($aux['anio']) ? $aux['anio'] : false ;
                $filter_year = $this->request('year');
                if ($filter_year) {
                     $escuelasaux = $c->find(array( 'programa'=>$this->programa->m_collection, "anio" => intval($filter_year) , "cct" => array('$regex' => '^'.$estado_id.'.*') ))->limit($limit)->skip($skip);
                
                } else if ($max_anio!==false) {
                    $escuelasaux = $c->find(array( 'programa'=>$this->programa->m_collection, "anio" => $max_anio , "cct" => array('$regex' => '^'.$estado_id.'.*') ))->limit($limit)->skip($skip);
                } else {
                    $escuelasaux = $c->find(array( 'programa'=>$this->programa->m_collection, "cct" => array('$regex' => '^'.$estado_id.'.*') ))->limit($limit)->skip($skip);
                }
                $i = 0;
                while($escuelasaux->hasNext()) {
                    $aux = $escuelasaux->getNext();
                    $escuelas[$i++] = $aux;//['cct'];
                }
            }

            $m->close();
        } catch(Exception $ex) {
            if ($this->debug) {
                var_dump($ex);
                throw $ex;
            }
            return $escuelas;
        }
        return $escuelas;
    }


}

?>
