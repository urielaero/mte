<?php
class escuelas extends main{
	public function index(){
		if($this->escuela_info()){			
			$params->limit = '0,8';
			$params->localidad = $this->escuela->localidad->id;
			$params->nivel = $this->escuela->nivel->id;		
			$params->ccts = array($this->escuela->cct);
			$params->order_by = ' ISNULL(escuelas.rank_entidad), escuelas.rank_entidad ASC';

			$this->load_compara_cookie();
			//$this->debug = true;
			$this->get_escuelas($params);
			//$this->escuelas[] = $this->escuela;
		
			if($this->compara_cookie){
				$temp = $this->escuelas;
				$params2->ccts = $this->compara_cookie;
				$this->get_escuelas($params2);
				$this->escuelas = array_merge($temp,$this->escuelas);
			}

			$this->process_escuelas();
			$this->cct_count_entidad();
			$this->escuelas_digest->zoom = 16;
			$this->escuelas_digest->centerlat = $this->escuela->latitud;
			$this->escuelas_digest->centerlong = $this->escuela->longitud;
			$this->header_folder = 'escuelas';
			$this->draw_map = true;
			$this->page_title = $this->capitalize($this->escuela->nombre).' - '.$this->escuela->cct.' - Mejora tu Escuela';
			$this->resultados_title = 'Escuelas similares <span>| Cercanas</span>';
			$this->breadcrumb = array(
				'/compara/'=>'Escuelas',
				'/compara/?search=true&entidad='.$this->escuela->entidad->id.'#resultados' => $this->capitalize($this->escuela->entidad->nombre),
				'/compara/?search=true&municipio='.$this->escuela->municipio->id.'&entidad='.$this->escuela->entidad->id.'#resultados' => $this->capitalize($this->escuela->municipio->nombre),
				'#'=> $this->capitalize($this->escuela->nombre)
			);
			//$this->include_theme('index','index');
			$this->title_header = 'Conoce tu escuela';
			$this->subtitle_header = 'El primer paso para poder mejorar tu centro escolar es saber <br />
			cómo está. Te invitamos a que conozcas y compartas esta<br />información.';
			$this->header_folder = 'compara';
			$this->include_theme('index','perfil_b');
		}else{
			header('HTTP/1.0 404 Not Found');
		}
	}
	public function escuela_info(){
		$this->escuela = new escuela($this->get('id'));
		//$this->escuela->debug = true;
		$this->escuela->has_many_order_by['calificaciones'] = 'calificaciones.likes DESC';
		$this->escuela->read("
			cct,nombre,colonia,domicilio,paginaweb,entrecalle,ycalle,promedio_general,promedio_matematicas,promedio_espaniol,rank_entidad,rank_nacional,rank_municipio,poco_confiables,total_evaluados,pct_reprobados,grados,
			entidad=>nombre,entidad=>id,municipio=>id,municipio=>nombre,localidad=>nombre,localidad=>id,
			codigopostal,telefono,telextension,fax,faxextension,correoelectronico,
			turno=>nombre,latitud,longitud,tipo=>nombre,
			nivel=>nombre,nivel=>id,subnivel=>nombre,servicio=>nombre,
			control=>id,control=>nombre,subcontrol=>nombre,sostenimiento=>nombre,status=>nombre,
			enlaces=>id,enlaces=>anio,enlaces=>grado,enlaces=>turnos,enlaces=>puntaje_espaniol,enlaces=>puntaje_matematicas,enlaces=>nivel,
			calificaciones=>calificacion,calificaciones=>id,calificaciones=>likes,calificaciones=>comentario,calificaciones=>nombre,
			reportes_ciudadanos=>id,reportes_ciudadanos=>likes,reportes_ciudadanos=>denuncia,reportes_ciudadanos=>nombre_input,reportes_ciudadanos=>publicar
		");
		if(isset($this->escuela->cct)){
			$this->escuela->get_semaforo();
			$this->escuela->line_chart_espaniol = $this->escuela->get_chart('espaniol');
			$this->escuela->line_chart_matematicas = $this->escuela->get_chart('matematicas');
			$nivel = "numero_escuelas_".strtolower($this->escuela->nivel->nombre);
			$entidad_info = new entidad($this->escuela->entidad->id);
			$entidad_info->read($nivel);
			$this->entidad_cct_count = $entidad_info->$nivel;
			$this->petition_data = $this->load_estado_petitions($this->escuela->entidad->nombre);
			return true;
		}else{
			return false;
		}
	}
	public function calificar(){
		$comment = strip_tags($this->post('comentario'));
		//if($this->post('calificacion')){
		$calificacion = new calificacion();
		//$calificacion->debug = true;
		$calificacion->create('nombre,email,cct,comentario,ocupacion,calificacion,user_agent',array(
			$this->post('nombre'),
			$this->post('email'),
			$this->post('cct'),
			$comment,
			$this->post('ocupacion'),
			$this->post('calificacion'),
			$_SERVER['HTTP_USER_AGENT']
		)); 
		$location = $calificacion->id ? "/escuelas/index/".$this->post('cct')."#calificaciones" : "/escuelas/index/".$this->post('cct')."/e=ce#calificaciones";
		header("location: $location");
		//}else{
		//	header("location: /escuelas/index/".$this->post('cct')."/e=ce#calificaciones");
		//}

	}
	public function like_calificacion(){
		$calif = new calificacion($this->get('id'));
		$calif->read('id,cct=>cct,likes=>id,likes=>ip');
		$calif->update('likes',array(count($calif->likes)+1));
		$like = new calificacion_like();
		$like->create('calificacion,ip,user_agent',array(
			$calif->id,
			$_SERVER['REMOTE_ADDR'],
			$_SERVER['HTTP_USER_AGENT']
		));
		header('location: /escuelas/index/'.$calif->cct->cct.'#calificaciones');
	}
	public function reportar(){
		$denuncia = strip_tags($this->post('denuncia'));
		$reporte_ciudadano = new reporte_ciudadano();
		$reporte_ciudadano->create('nombre_input,email_input,denuncia,ocupacion,categoria,publicar,cct,user_agent',array(
			$this->post('nombre_input'),
			$this->post('email_input'),
			$denuncia,
			$this->post('ocupacion'),
			$this->post('categoria'),
			$this->post('publicar'),
			$this->post('cct'),
			$_SERVER['HTTP_USER_AGENT']
		));
		$location = $reporte_ciudadano->id ? "/escuelas/index/".$this->post('cct')."#reportes_ciudadanos" : "/escuelas/index/".$this->post('cct')."/e=ce#reportes_ciudadanos"; 
		header("location: $location");
	}
	public function like_reportar(){
		$reporte = new reporte_ciudadano($this->get('id'));
		$reporte->read('id,cct=>cct,likes=>id,likes=>ip');
		$reporte->update('likes',array(count($reporte->likes)+1));
		$like = new reporte_ciudadano_like();
		$like->create('denuncia,ip,user_agent',array(
			$reporte->id,
			$_SERVER['REMOTE_ADDR'],
			$_SERVER['HTTP_USER_AGENT']
		));
		header('location: /escuelas/index/'.$reporte->cct->cct.'#reportes_ciudadanos');
	}

	public function str_limit($str,$limit){
		$length = strlen($str)/$limit;
		$newStr = "";
		$temp = 0;
		for($i=0;$i<$length;$i++){
			$newStr = $newStr." ".substr($str,$temp,$limit);
			$temp += $limit;
		}
		return $newStr;
	}
}
?>
