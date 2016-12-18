<?php
require_once("test.default.php");

class escuelasTest extends defaultTest{
	public function setUp(){
		parent::setUp();
		$this->controler = new escuelas($this->config);
	}

	public function testDB(){
		//all_grados
		$info =  "nivel primaria total 101747 con errores 0\nnivel secundaria total 35267 con errores 0\nnivel bachillerato total 13934 con errores 11504";
		//$this->AssertEquals(false,true,$info);
	}

	public function all_grados(){
		$fields = array('grados','promedio_matematicas','promedio_espaniol','promedio_general','total_evaluados');
		$fieldsTxt = "tipo,cct,".implode(",",$fields)."\n";
		//echo $fieldsTxt;
		$nivel = new nivel();
		$nivel->search_clause = 1;
		$niveles = $nivel->read('id');
		$niveles = array(12,13,22);
		foreach($niveles as $n){		
			$this->escuela_grados($n,$fields);	
		}
	}
	
	private function escuela_grados($nivel,$fields){
		$escuela = new escuela();
		$escuela->search_clause = "nivel = $nivel";
		$escuela = $escuela->read('cct,grados,promedio_matematicas,promedio_espaniol,promedio_general,total_evaluados,nivel=>nombre');
		$countTotal = count($escuela);
		$countError = 0;
		foreach($escuela as $e){
			if($e->cct != "NA"){
				$values = array();
				foreach($fields as $key){
					$values[] = $e->$key;
				}
				$expected = $this->enlace_por_anio(2013,$e->cct);
				if(!$expected){//no enlace
					continue;
				}
				if($e->grados != $expected[0]){	
					$valid = $this->is_equals($values,$expected);
					//$this->AssertEquals($values,$expected);
					if(!$valid){
						$expected2 = $this->enlace_por_anio(2012,$e->cct);
					    	$valid = $this->is_equals($values,$expected2);
					    	//$this->AssertEquals($values,$expected2);
					    	if($valid){
					    		//echo $e->cct.",coincide con el año 2012";
					    	}else{
					    		//echo $e->cct.",no coincide recalculo 2013 ni 2012";
							$countError++;
					    	}
					    	//echo ",".$e->total_evaluados.",$expected[4]\n";
					}
				}
			}
		}
		echo "nivel ".strtolower($e->nivel->nombre)." total ".$countTotal." con errores ".$countError."\n";

	}

	private function enlace_por_anio($anio,$cct){
		$enlace =  new enlace();	
		$enlace->search_clause = 'cct="'.$cct.'" AND anio = "'.$anio.'"';
		$enlaces = $enlace->read('id,anio,nivel,grado,turnos,puntaje_espaniol,puntaje_matematicas,puntaje_geografia,alumnos_que_contestaron_total');
		if(count($enlaces)){
			$grados = $sum_spa = $sum_mat = $sum_geo = 0;
			$alumnos_total = 0;
			foreach($enlaces as $enlace){
				if($enlace->alumnos_que_contestaron_total != 0 && ($enlace->puntaje_espaniol != 0 && $enlace->puntaje_matematicas != 0)){
					$grados++;
					$sum_spa += $enlace->puntaje_espaniol;
					$sum_mat += $enlace->puntaje_matematicas;
					$alumnos_total += $enlace->alumnos_que_contestaron_total;
				}
			}
			$prom_mat = $sum_mat / $grados;
			$prom_spa = $sum_spa / $grados;
			$gen = ($prom_spa * .2) + ($prom_mat *.8);
			return  array($grados,$prom_mat,$prom_spa,$gen,$alumnos_total);
		}else
			return false;

	}

	private function is_equals($values,$expected){
		foreach($values as $i=>$value){
			if($value != $expected[$i]){
				return false;
			}
		}
		return true;
	
	}

}

/*$tmp = new escuelasTest();
$tmp->setUp();
$tmp->all_grados();
*/
?>
