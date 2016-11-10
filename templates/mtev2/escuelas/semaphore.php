<?php $on = $this->escuela_per_turno->current_semaforo;
	switch ($on) {
		case "Prueba ENLACE no disponible para este nivel escolar";
		case "No toma la prueba ENLACE";
		case "Esta escuela no toma la prueba ENLACE para todos los años";
		case "No tomó la prueba PLANEA":
		?>
				<div id="cont-samaforo-icono">
					<div class="cont-samaforo-icono">
						<i id="icono-semaphore" class="icon-notomaenlace"></i>
						<h5 class="h5-semaforo-on"><?php echo $on ?></h5>
					</div>
				</div>
	<?php	break;
		case "Poco confiable"; 
		//planea
		case "No confiable";
		case "Resultados no confiables";
		case "No representativo";
		case "Resultados no representativos";
		case "Evaluados es menor al 80%":
		case "El porcentaje de evaluados es menor al 80%";
		?>
				<div id="cont-samaforo-icono">
					<div class="cont-samaforo-icono">
						<i id="icono-semaphore" class="icon-pococonfiable"></i>
						<h5 class="h5-semaforo-on"><?php echo $on ?></h5>
					</div>
				</div>
	<?php	break;
		case "De panzazo"; // == De panzaso
		case "Bien"; // == bueno
		case "Reprobado";
		case "Excelente";
		//planea
		case "De panzaso";
		case "Bueno":
		 ?>
<ul>
	<li class="rank1<?=$on=='Excelente'?' on':''?>">
		<div layout="row">
			<div flex="70" class="label">Excelente</div>
			<div flex="30" class="circle">
		        <md-button class="md-fab" aria-label="Time"><i class="icon-check-01"></i></md-button>									
			</div>
		</div>
	</li>
	<li class="rank2<?=($on=='Bien'||$on=='Bueno')?' on':''?>">
		<div layout="row">
			<div flex="70" class="label">Bien</div>
			<div flex="30" class="circle">
		        <md-button class="md-fab" aria-label="Time"><i class="icon-check-01"></i></md-button>									
			</div>
		</div>
	</li>
	<li class="rank3<?=($on=='De panzazo'||$on=='De panzaso')?' on':''?>">
		<div layout="row">
			<div flex="70" class="label">De panzazo</div>
			<div flex="30" class="circle">
		        <md-button class="md-fab" aria-label="Time"><i class="icon-tache-01"></i></md-button>									
			</div>
		</div>
	</li>
	<li class="rank4<?=$on=='Reprobado'?' on':''?>">
		<div layout="row">
			<div flex="70" class="label">Reprobado</div>
			<div flex="30" class="circle">
		        <md-button class="md-fab" aria-label="Time"><i class="icon-tache-01"></i></md-button>									
			</div>
		</div>
	</li>
</ul>
		
		<?php break;
	}
?>
