<?php
class escuela extends memcached_table{
	public function info(){
		$this->table_name = "escuelas";
		$this->key = 'id';
		$this->objects['localidad'] = 'localidad';
		$this->objects['entidad'] = 'entidad';
		$this->objects['municipio'] = 'municipio';
		$this->objects['nivel'] = 'nivel';
		$this->objects['turno'] = 'turno';
		$this->objects['tipo'] = 'tipo';
		$this->objects['subnivel'] = 'subnivel';
		$this->objects['servicio'] = 'servicio';
		$this->objects['control'] = 'control';
		$this->objects['subcontrol'] = 'subcontrol';
		$this->objects['sostenimiento'] = 'sostenimiento';
		$this->objects['status'] = 'status';

		$this->has_many['enlaces'] = 'enlace';
		$this->has_many_keys['enlaces'] = 'cct';

		$this->has_many['calificaciones'] = 'calificacion';
		$this->has_many_keys['calificaciones'] = 'cct';

		$this->has_many['reportes_ciudadanos'] = 'reporte_ciudadano';
		$this->has_many_keys['reportes_ciudadanos'] = 'id_cct';

        $this->has_many['rank'] = 'rank';
        $this->has_many_keys['rank'] = 'id';

		$this->semaforos = array('Reprobado','De Panzazo','Bien','Excelente','Sin Enlace','Poco confiable');
		#$this->semaforo_rangos[12] = array(433,524,615,900);
		$this->semaforo_rangos[12] = array(559,601,662,900);
		$this->semaforo_rangos[13] = array(511,544,591,900);
        $this->semaforo_rangos[21] = array(562.47,593.39,646.05,900);
		$this->semaforo_rangos[22] = array(562.47,593.39,646.05,900);
		$this->semaforo_poco_confiable = 10;

	}
	public function get_semaforo(){
		$this->semaforo = 4;
		$porcentaje_poco_confiable = $this->poco_confiables > 0 && $this->total_evaluados > 0?($this->poco_confiables * 100) / $this->total_evaluados:0;
		$this->porcentaje_poco_confiable = number_format($porcentaje_poco_confiable,2);
		$turnos = isset($this->turno->num) ? $this->turno->num : 1;

		if($this->nivel->nombre=="PREESCOLAR"){
			$this->semaforo = 7;		
		}
		if(isset($this->grados) && $this->grados>0 ){
			if($this->nivel->nombre != "BACHILLERATO"  && ($this->grados < 4 * $turnos && $this->nivel->nombre == "PRIMARIA") || ($this->grados < 3 * $turnos && $this->nivel->nombre == "SECUNDARIA") ){
				$this->semaforo = 6;//no se cuentan
			}else{
				
				if($porcentaje_poco_confiable > 0 && $porcentaje_poco_confiable >= $this->semaforo_poco_confiable){
					$this->semaforo = 5;//no confiables
				}else{
					
					if( $this->promedio_general > 0){
						
						if( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][0])
							$this->semaforo=0;
						else
							if( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][1] )
								$this->semaforo = 1;
							else
								if( $this->promedio_general < $this->semaforo_rangos[$this->nivel->id][2] )
									$this->semaforo = 2;
								else
									$this->semaforo = 3;
				    }
			    }
		    }
		}
	}

    public function get_semaforos(){
        $this->semaforo = 4;

        if($this->nivel->nombre=="PREESCOLAR"){
            $this->semaforo = 7;
            return;
        }
        if(preg_match('/^..BB/', $this->cct)){
            $this->semaforo = 8;
            return;
        }

        //deprecado ya no deberia usar este atributo , todas las escuelas vienen por turno
        if (isset($this->rank) && count($this->rank) > 0) {
            foreach ($this->rank as $rank) {
                $this->get_semaforo_new($rank);

                foreach($this->turnos as $turno){
                    if ($rank->turnos_eval == $turno->id) {
                        $rank->turno = array();
                        $rank->turno[0] = new stdClass();
                        $rank->turno[0]->nombre = $turno->nombre;
                    }
                }
            }
        } else {
            $this->get_semaforo_new($this);
        }
    }

    public function get_semaforo_new($rank){
        if (!$rank) return false;
        $semaforo = 4;
        $nivel = isset($this->nivel->id) ? $this->nivel->id : $this->nivel;

        if($nivel==21 || $nivel==22){
            $semaforo = $this->get_semaforo_new_bachillerato($rank);
        }
        else{
            if(isset($rank->promedio_general) && $rank->promedio_general != ''){
                if($rank->promedio_general > 0) {//si todos los anios fueron evaluados
                    if ((!isset($rank->rank_entidad) && !isset($rank->rank_nacional)) || (!ctype_digit((string)$rank->rank_entidad) && !ctype_digit((string)$rank->rank_nacional))){
                        $semaforo = 5;//poco confiable
                    }
                    else if( $rank->promedio_general < $this->semaforo_rangos[$nivel][0])
                        $semaforo = 0;//amarillo
                    else
                        if( $rank->promedio_general < $this->semaforo_rangos[$nivel][1] )
                            $semaforo = 1;//verde
                        else
                            if( $rank->promedio_general < $this->semaforo_rangos[$nivel][2] )
                                $semaforo = 2;//naranja
                            else
                                $semaforo = 3;//reprobado
                } else {

                    $semaforo = 6;//no se cuentan
                }
            }
        }

        if ($this->semaforo >  $semaforo) {
            $this->semaforo = $semaforo;
        }

        $rank->semaforo = $semaforo;
        return $semaforo;
    }

    private function get_semaforo_new_bachillerato($rank){
        if (!$rank) return false;
        $semaforo = 4;
        $nivel = isset($this->nivel->id) ? $this->nivel->id : $this->nivel;

        if ($rank->anio == 2013){
            return $semaforo;
        }

        if($rank->promedio_general>0 && $rank->total_evaluados>5 && $rank->eval_entre_programados>.8){
            if( $rank->promedio_general < $this->semaforo_rangos[$nivel][0])
                $semaforo = 0;//amarillo
            else
                if( $rank->promedio_general < $this->semaforo_rangos[$nivel][1] )
                    $semaforo = 1;//verde
                else
                    if( $rank->promedio_general < $this->semaforo_rangos[$nivel][2] )
                        $semaforo = 2;//naranja
                    else
                        $semaforo = 3;//reprobado
        } else {
            $semaforo = 6;//no se cuentan
        }

        if ($this->semaforo >  $semaforo) {
            $this->semaforo = $semaforo;
        }

        $rank->semaforo = $semaforo;
        return $semaforo;
    }

	public function rank($nivel,$entidad = false,$municipio = false){
		$entidad_clause = $entidad ? " AND entidad LIKE '$entidad'" : '';
		$sql = "SET @rownum = 0, @rank = 0, @prev_val = NULL; ";
		mysql_query($sql);
		$sql = "UPDATE escuelas t1
				JOIN (
				SELECT @rownum := @rownum + 1 AS row,
				@rank := IF(@prev_val!=promedio_general,@rownum,@rank) AS rank,
				@prev_val := promedio_general AS promedio_general,
				cct
				FROM escuelas
				WHERE nivel LIKE '$nivel' $entidad_clause AND `promedio_general` IS NOT NULL
				ORDER BY promedio_general DESC) t2
				ON t1.cct=t2.cct
				SET t1.rank_entidad=t2.rank;";
		return mysql_query($sql);		
	}
	public function get_mongo_info($client){
        if($client){
            $db = $client->selectDB("censo_completo_2013");
            $collection = $db->selectCollection('datos_escuelas_v2');
            $escuelas = $collection->find(array( 'cct_escuelas' => $this->cct))->sort(array('id_turno'=>1));
            $first = false;
            $censo = false;
            foreach($escuelas as $escuela) {
                if (!$first) {
                    $first = true;
                    $censo = $escuela;
                    $censo['turnos'] = array();
                }
                $turno = new stdClass();
                $variables = array('turno'=>'nombre','num_alumnos'=>'alumnos','num_personal'=>'personal','num_grupos'=>'grupos','id_turno'=>'id');
                foreach( $variables as $key=>$val) {
                    if(isset($escuela[$key]) && strlen(trim($escuela[$key]))>0)
                        $turno->$val = $escuela[$key];
                }
                $censo['turnos'][] = $turno;
            }

            $this->censo = $censo;
            if(isset($this->verificado) && !$this->verificado && $this->censo && isset($this->censo['telefono'])) $this->telefono = $this->censo['telefono'];

            if($this->censo && isset($this->censo['persona_responsable'])) $this->director = $this->censo['persona_responsable'];
	    if (isset($this->verificado) && !$this->verificado && $this->censo) {
		if($this->censo && isset($this->censo['calle'])) $this->domicilio = $this->censo['calle'].' no.'.$this->censo['numero_dir'];
		if($this->censo && isset($this->censo['calle'])) $this->domicilio = $this->censo['calle'].' no.'.$this->censo['numero_dir'];
	    
	    }

            #if($this->censo && isset($this->censo['localidad_en_mapa'])) $this->localidad->nombre = $this->censo['localidad_en_mapa'];
            #if($this->censo && isset($this->censo['municipio_en_mapa'])) $this->municipio->nombre = $this->censo['municipio_en_mapa'];
            #if($this->censo && isset($this->censo['edo_en_mapa'])) $this->entidad->nombre = $this->censo['edo_en_mapa'];
            #if($this->censo && isset($this->censo['nombre'])) $this->nombre = $this->censo['nombre'];
            
            //longitud
            if($this->censo && isset($this->censo['coord2'])) $this->longitud = $this->censo['coord2'];
            //latitud
            if($this->censo && isset($this->censo['coord1'])) $this->latitud = $this->censo['coord1'];

            $this->infraestructura = false;

            $db = $client->selectDB("mte_programas");
            $this->load_programas2($db);

			$client->close();
		}else{
			$programas = array('censo_2013','snie','infraestructura', 'pec','pes','petc','siat','proeducacion','tarahumara','teach_mexico','mexprim','empresa_impulsa','emprender_impulsa','emprendedores_impulsa','dinero_impulsa','fundacion_televisa','naciones_unidas');
			foreach($programas as $programa){
				$this->$programa = false;
			}
		}
	}
    private function createSchoolData(&$sql){
        $q = pg_query($this->conn,$sql);
        #if the search don't return any column but there was no error, a insert/update/delete query was used.
        if( pg_num_rows($q)==0 )
            $resp = true;
        else{
            $salidas = array();
            while ($row =pg_fetch_assoc($q) ){
                $salida = new stdClass();
                $salida->id = $row['turnos_eval'];
                $salida->nombre = $row['nombre'];
		$salidas[] = $salida;
                //return $salida;
            }
	    return $salidas;
        }
        return NULL;
    }
	public function get_turnos($memcache_host = NULL){
        $sql = "select distinct e.turnos_eval,t.nombre from escuelas_para_rankeo e inner join turnos t on t.id = e.turnos_eval where e.id ={$this->id}";
        if($memcache_host!=NULL && class_exists('Memcache') && false){
            $memcache = new Memcache;
            $memcache->connect($memcache_host, 11211);
            $this->execute = true;
            $query_hash = sha1($sql);
            if($result = $memcache->get($query_hash)){
                $this->turnos = $result;
                //foreach($escuelas as $escuela) $escuela->conn = $this->conn;
                return true;
            }else{
                $turnos = $this->createSchoolData($sql);
                //$this->turnos[] = $turnos;
                $this->turnos = $turnos;
                $memcache->set($query_hash,$turnos,false,0);
            }
            return true;
        }else{
            //$this->turnos[] = $this->createSchoolData($sql);
            $this->turnos = $this->createSchoolData($sql);
        }
    }
    public function get_charts(){
        $this->line_chart_espaniol = $this->get_chart('espaniol');
        $this->line_chart_matematicas = $this->get_chart('matematicas');

        $this->espaniol_charts = array();
        $this->matematicas_charts = array();
        if($this->rank){
            foreach($this->rank as $rank){
                $this->espaniol_charts[$rank->turnos_eval] = $this->get_chart('espaniol',$rank->turnos_eval);
                $this->matematicas_charts[$rank->turnos_eval] = $this->get_chart('matematicas',$rank->turnos_eval);
            }
        }
    }
    public function get_chart($materia,$turno = false){
        $grados = array();
        $enlaces = array();
        $puntaje_name = 'puntaje_'.$materia;
        if(isset($this->enlaces) && $this->enlaces){
            $variable = array();
            foreach($this->enlaces as $enlace){
                if ($turno && $enlace->turnos != $turno) {
                    continue;
                }
                #if(isset($enlaces[$enlace->anio][$enlace->grado])){
                #	echo 'mult';
                #	$enlaces[$enlace->anio][$enlace->grado] = round(
                #		( $enlaces[$enlace->anio][$enlace->grado] + $enlace->$puntaje_name )
                #	/ (count($enlaces[$enlace->anio][$enlace->grado]) + 1));
                #}else{
                $enlaces[$enlace->anio][$enlace->grado] = round($enlace->$puntaje_name);
                #}
                $grados[$enlace->grado] = $enlace->grado;
            }
            ksort($enlaces);
            //var_dump($enlaces);
            $grados = array_values($grados);
            sort($grados);
            $keys = array_flip($grados);
            array_unshift($grados,'Año');
            $variable[] = $grados;
            foreach($enlaces as $anio => $grados){
                $row = array_fill(0,count($keys),0);
                foreach($grados as $key => $puntaje){
                    $row[$keys[$key]] = intval($puntaje);
                }
                array_unshift($row,strval($anio));
                $variable[] = $row;
            }
        }else{
            $variable = false;
        }
        return $variable;
    }
    public function get_turnos_rank(){
        $rank = new rank(NULL,$this->conn);
        //$rank->debug = true;
        $rank->search_clause = "escuelas_para_rankeo.id = {$this->id}";
        $ranks = $rank->read('id,turnos_eval,promedio_general,promedio_matematicas,promedio_espaniol,total_evaluados,pct_reprobados,poco_confiables,rank_entidad,rank_nacional,eval_entre_programados');
        $this->rank = $ranks;
    }
    public function clean_ranks(){
        $max = 0;
        if(isset($this->rank)){
            foreach($this->rank as $key => $rank){
                if($rank->anio > $max) $max = $rank->anio;
            }
            foreach($this->rank as $key => $rank){
                if($rank->anio < $max) unset($this->rank[$key]);
            }
        }
    }
    private function load_programas($programas,$db){
		foreach($programas as $programa){
			$c = $db->selectCollection($programa);
			$this->$programa = $c->find(array('cct'=>$this->cct));
			$this->$programa = iterator_to_array($this->$programa);
		}
	}
    private function load_programas2($db){
        $c = $db->selectCollection("normalizados");
        $results = $c->find(array('cct'=>$this->cct));
        $this->programas = array();
        foreach($results as $res){
            //var_dump($res);
            $programaName = $res['programa'];
            if (!isset($this->programas[$programaName])) {
                $programa = new stdClass();
                $programa->anios = array();
                $this->programas[$programaName] = $programa;
            }
            $this->programas[$programaName]->anios[] = $res['anio'];
            if(isset($res['ganador']) && $res['ganador'] == 1){
                $this->ganador_disena_el_cambio = $res['ganador'];
            }
        }
    }
    public function yearAvgs(){
        if($this->id){
            $this->key = 'id';
            $this->has_many_keys['enlaces'] = 'id_cct';
            $this->avgs = [];
            $this->read('
                enlaces=>puntaje_espaniol,enlaces=>puntaje_matematicas,enlaces=>anio,enlaces=>id,
                enlaces=>alumnos_en_nivel0_matematicas,enlaces=>alumnos_en_nivel1_matematicas,enlaces=>alumnos_en_nivel2_matematicas,enlaces=>alumnos_en_nivel3_matematicas,
                enlaces=>alumnos_en_nivel0_espaniol,enlaces=>alumnos_en_nivel1_espaniol,enlaces=>alumnos_en_nivel2_espaniol,enlaces=>alumnos_en_nivel3_espaniol,
                enlaces=>alumnos_que_contestaron_total
            ');
            if($this->enlaces){
                $scores = [];
                foreach($this->enlaces as $enlace){
                    if($enlace->puntaje_espaniol != 0 || $enlace->puntaje_matematicas != 0){
                        if(!isset($scores[$enlace->anio])){
                            $scores[$enlace->anio] = new stdClass();
                            $scores[$enlace->anio]->sum = 0;
                            $scores[$enlace->anio]->count = 0;
                        }
                        $scores[$enlace->anio]->sum += $enlace->puntaje_espaniol + $enlace->puntaje_matematicas;
                        $scores[$enlace->anio]->count++;
                    }
                }
                foreach($scores as $year => $score){
                    $this->avgs[$year] = $score->count ? round($score->sum/($score->count*2)) : '--';
                }

            }
        }
    }
    // Genera un arreglo de estadisticas para una escuela.
    // suma los turnos
    // para la tabla de resultados por alumno, ejecutar despues de yearAvgs (para tener los enlaces cargados)
    public function yearStats(){
        if($this->enlaces){
            $scores = [];
            foreach($this->enlaces as $enlace){
                if(!isset($scores[$enlace->anio])){
                    $scores[$enlace->anio] = new stdClass();
                    $scores[$enlace->anio]->mat = [0,0,0,0];
                    $scores[$enlace->anio]->esp = [0,0,0,0];
                    $scores[$enlace->anio]->esp = [0,0,0,0];
                    $scores[$enlace->anio]->alumnos = 0;
                } 

                $scores[$enlace->anio]->mat[0] += $enlace->alumnos_en_nivel0_matematicas;
                $scores[$enlace->anio]->mat[1] += $enlace->alumnos_en_nivel1_matematicas;
                $scores[$enlace->anio]->mat[2] += $enlace->alumnos_en_nivel2_matematicas;
                $scores[$enlace->anio]->mat[3] += $enlace->alumnos_en_nivel3_matematicas;

                $scores[$enlace->anio]->esp[0] += $enlace->alumnos_en_nivel0_espaniol;
                $scores[$enlace->anio]->esp[1] += $enlace->alumnos_en_nivel1_espaniol;
                $scores[$enlace->anio]->esp[2] += $enlace->alumnos_en_nivel2_espaniol;
                $scores[$enlace->anio]->esp[3] += $enlace->alumnos_en_nivel3_espaniol;

                $scores[$enlace->anio]->alumnos += $enlace->alumnos_que_contestaron_total;
            }
            $this->stats = $scores;
        }
    }

    public function setEducAccion($client, $year){
    	$data = array('cct' => $this->cct, 'programa' => 'educaccion', 'anio'=> new MongoInt32(intval($year)));
        $db = $client->selectDB("mte_programas");
        $coll = $db->selectCollection("normalizados");
        $result = $coll->findOne($data);
        if($result){
            return true;
        }
        //insert.
        $res = $coll->insert($data);
        if(isset($res["ok"])){
            return true;
        }
        return false;
    }

    public function get_planea(){
        $escuela = new planea_escuela($this->cct, $this->conn);
        $escuela->read("id,cct,evaluados,porcentaje_nivel1_espaniol,porcentaje_nivel2_espaniol,porcentaje_nivel3_espaniol,porcentaje_nivel4_espaniol,porcentaje_nivel1_matematicas,porcentaje_nivel2_matematicas,porcentaje_nivel3_matematicas,porcentaje_nivel4_matematicas,clave_nivel,entidad,clave_semaforo,rank_entidad");
        $promedio = new planea_promedio(null, $this->conn);
        $promedios = $promedio->promedios($escuela->entidad, $escuela->clave_nivel);//filter by turno ?...
        $this->planea = new stdClass();
        $this->planea->rank_entidad = $escuela->rank_entidad;
        $this->planea_charts($escuela, $promedios);
        $this->planea_semaforo($escuela);
        $this->planea->semaforo_clave = $this->get_planea_semaforo($escuela);
        $this->planea->num_evaluados = $escuela->evaluados;
    }

    private function planea_charts($escuela, $promedios) {        
        $turno = $this->turno->id;
        $this->planea->matematicas_charts = $this->make_planea_chart($escuela, $promedios, 'matematicas');
        $this->planea->espaniol_charts = $this->make_planea_chart($escuela, $promedios, 'espaniol');
        $this->planea->evaluados = $escuela->evaluados;
    }

    private function make_planea_chart($escuela, $promedios, $materia) {
        $title_x = array("nivel", "escuela","tooltip", "entidad", "nacional");
        $title_y = array("nivel1", "nivel2", "nivel3", "nivel4");
        $names = array("Insuficiente", "Indispensable", "Satisfactorio", "Sobresaliente");
        $tooltips = array(
            "Nivel I: Logro insuficiente de los aprendizajes clave del currículum,
            que refleja carencias fundamentales que dificultarán el aprendizaje 
            futuro", 
            "Nivel II: Logro apenas indispensables de los aprendizajes 
            clave del currículum", 
            "Nivel III: Logro satisfactorio de los aprendizajes 
            clave del currículum",
            "Nivel IV: Logro sobresaliente de los aprendizajes
            clave del currículum"
        );
        $field = "porcentaje_nivel";
        $chart = array($title_x);
        for($i=1;$i<=4;$i++) {
            $field_name = $field."{$i}_".$materia;
            $nivel = $title_y[$i-1];
            $local = $escuela->$field_name;
            $entidad = $promedios["{$this->entidad}_".$materia]->$nivel;
            $nacional = $promedios["0_".$materia]->$nivel;
            $tooltip = $tooltips[$i-1].". {$names[$i-1]}: ".floatval($local)." %";
            $chart[] = array($names[$i-1], floatval($local), $tooltip, floatval($entidad), floatval($nacional));
        }
        return $chart;
    }

    private function planea_semaforo($escuela) {
        $semaforo = new planea_semaforo($escuela->clave_semaforo, $this->conn);
        $semaforo->read("nombre");
        if(!isset($semaforo->nombre) || $semaforo->nombre == null) {
            $semaforo = new StdClass;
            $semaforo->nombre = "No tomó la prueba PLANEA";
            $semaforo->clave = 8;
        }
        $this->planea->semaforo = $semaforo;
    }

    private function get_planea_semaforo($escuela) {
        if($this->nivel->nombre=="PREESCOLAR"){
            return 0;
        }
        if(preg_match('/^..BB/', $this->cct)){
            return 0;
        }

        if (!$escuela || !isset($escuela->clave_semaforo)) {
            return 8;
        }

        return $escuela->clave_semaforo;
    }

    public function get_planea_info() {
        $escuela = new planea_escuela($this->cct, $this->conn);
        $escuela->read("id,cct,clave_semaforo,rank_entidad");    
        $this->planea = new StdClass();
        $this->planea->rank_entidad = $escuela->rank_entidad;
        $this->planea->semaforo = $this->get_planea_semaforo($escuela);
    }
}
?>
