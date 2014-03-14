<?php

/**
* Clase mejora Extiende main.
* Controlador: host/mejora
*/
class mejora extends main{
	/**
	* Funcion Publica index.
	* Obtiene los datos necesarios para el correcto funcionamiento de las vistas.
	*/
	public function index(){
		/* Obtiene los datos necesarios para el correcto funcionamiento de las vistas. */
		$this->include_theme('index','index');
		$this->common_data();
	}

	private function common_data(){
		$this->title_header = 'Mejora tu escuela';
		$this->subtitle_header = 'Aquí encontrarás herramientas para que actúes como agente <br />de cambio positivo en tu comunidad educativa. <br />¡Participa e involúcrate!';
		$this->header_folder = 'compara';
		$this->breadcrumb = array('#'=>'Mejora');
		$this->meta_description = "Tú puedes ayudar a tus hijos a hacer sus tareas y formar hábitos de lectura. En Mejora tu escuela tenemos tips para papás y niños que les ayudarán a aprender mejor.";
	
	}

	public function enviar(){
		$this->contact_status = $this->send_email(
			$this->config->contact_email,
			'Correo electronico desde Mejora tu escuela desde sección "mejora": '.$this->post('email'),
			$this->post('mensaje'),
			'system@mejoratuescuela.org',
			'sección mejora' 
		);
		$this->index();
	}

	public function programas(){
		$this->common_data();
		if($id = $this->get('id')){
			$filtroF = array();
			$filtro = array();
		    if(is_numeric($id)){
			$ps = new programa();
			$ps->search_clause = " 1";
			$programas = $ps->read('id,nombre,m_collection,tema_especifico,federal');
			foreach($programas as $p){
				$count_cct = $this->get_estado_escuelas_count($p->m_collection);
				if($count_cct[$id]>0){
					if($p->federal){
						$filtroF[] = $p;
					}else{
						$filtro[] = $p;
					}
				}
			
			}		    
		    }else{
			$paramas = new StdClass();
			$id = strtoupper($id);
			$programas_array = array();
		    	for($i=2;$i<16;$i++){
			    	$ccts = $this->get_estado_escuelascct($i,"",0,0);
				$params->ccts = $ccts;
		        	$this->get_escuelas($params);
				foreach($this->escuelas as $es){
					if(strtoupper($es->nivel->nombre) == $id){
						$programas_array[$i] = 1;
					}
				}
			}

		    }

		    foreach($programas_array as $pr => $du){
		    	$p = new programa($pr);
			$p->read('id,nombre,m_collection,tema_especifico,federal');
			if($p->federal){
				$filtroF[] = $p;
			}else{
				$filtro[] = $p;
			}
		    }
		    $this->programas_federales = $filtroF;
		    $this->programas_osc = $filtro;

		}else{
			$this->load_programas();
		}
		$this->include_theme('index','programas');
	}
}
?>
