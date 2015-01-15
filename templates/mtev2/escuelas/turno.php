<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
<div class="space-between" layout="row" layout-sm="column">
	<div class="main-info" flex="73" flex-sm="100">
		<div layout="row" layout-sm="column">
			<div id="map" flex="50"></div>
			<div class="info" flex="50" flex-sm="100">
				<div class="califica" layout="row">
					<div flex="35" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-califica2-01"></i>
						</div>
					</div>
					<div flex="65">
						<h4>CALIFICA TU ESCUELA</h4>
					</div>
					<a href="#" class="full-size-link"></a>
				</div>
				<div class="block">
					<ul>
						<li>Clave: <?=$this->escuela->cct?></li>
						<li><?=$this->capitalize($this->escuela->nivel->nombre)?></li>
						<li>Turno: <?=$this->capitalize($this->escuela->turno->nombre)?></li>
						<li><?=$controles[$this->escuela->control->id]?></li>
						<li>Télefonos: <?=$this->escuela->telefono?></li>
						<?php if(isset($this->escuela->correoelectronico) && $this->escuela->correoelectronico){?>
							<li>Correo electrónico:<?=$this->escuela->correoelectronico?> </li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="address" layout="row" layout-sm="column">
			<div flex>
				<ul>
					<li>Calle: <?=$this->capitalize($this->escuela->domicilio)?></li>
					<li>Municipio: <?=$this->capitalize($this->escuela->municipio->nombre)?></li>
				</ul>
			</div>
			<div flex>
				<ul>
					<li>Localidad: <?=$this->capitalize($this->escuela->localidad->nombre)?></li>
					<li>Entidad: <?=$this->capitalize($this->escuela->entidad->nombre)?></li>
				</ul>
			</div>
		</div>
		<div class="counters" layout="row" layout-sm="column">
			<div flex><div layout="row" layout-margin>
				<div flex>Número de alumnos:</div>
				<div flex class="number"><?=$this->escuela_per_turno->total_evaluados?></div>
			</div></div>
			<div flex><div layout="row" layout-margin>
				<div flex>Número de alumnos:</div>
				<div flex class="number"><?=$this->escuela_per_turno->total_evaluados?></div>
			</div></div>
			<div flex><div layout="row" layout-margin>
				<div flex>Número de alumnos:</div>
				<div flex class="number"><?=$this->escuela_per_turno->total_evaluados?></div>
			</div></div>
		</div>
	</div>
	<?php if($this->escuela->nivel->nombre == 'PREESCOLAR'){ ?>
	<div flex="25" flex-sm="100">
		<div class="section-image">
			<img src="/templates/mtev1/img/cubitos.png" alt="Preescolar">			
		</div>
	</div>	
	<?php 
		}else{
	?>
	<div class="semaphore" flex="25" flex-sm="100">
		<h4>Semáforo educativo</h4>
		<?php $on = $this->escuela_per_turno->semaforo?>
		<ul>
			<li class="rank1<?=$on=='Excelente'?' on':''?>">
				<div layout="row">
					<div flex="70" class="label">Excelente</div>
					<div flex="30" class="circle">
				        <md-button class="md-fab" aria-label="Time"><i class="icon-check-01"></i></md-button>									
					</div>
				</div>
			</li>
			<li class="rank2<?=$on=='Bien'?' on':''?>">
				<div layout="row">
					<div flex="70" class="label">Bien</div>
					<div flex="30" class="circle">
				        <md-button class="md-fab" aria-label="Time"><i class="icon-check-01"></i></md-button>									
					</div>
				</div>
			</li>
			<li class="rank3<?=$on=='De panzazo'?' on':''?>">
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
		<div class="options space-between" layout="row" layout-md="column">
			<div flex="49" class="option">
					<p><i class="icon-print-01"></i></p>
					<p>Imprimir</p>
			</div>
			<div flex="49" class="option">
					<p><i class="icon-share-01"></i></p>
					<p>Compartir</p>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<div class="additional-info space-between" layout="row" layout-sm="column">
	<div class="data" flex="73" flex-sm="100">
		<form action="/" method="GET" class="comment-form">
			<div layout="row" ng-click="toggleFormEvent()">
				<div flex="10" class="icon-container" hide-sm>
					<i class="icon-comentario-01"></i>
				</div>						
				<textarea flex="90" flex-sm="100" placeholder="Deja un comentario de esta escuela aquí"></textarea>
			</div>
			<div class="extra animated fadeInDown" ng-show="toggleForm">
				<div class="fields" layout="row" layout-margin layout-fill layout-padding>
					<input type="text" name="nombre" flex placeholder="Nombre">
					<input type="email" name="correo" flex placeholder="Correo electrónico">
					<select flex>
						<option value="">¿Quien eres?</option>
					</select>
				</div>
				<div class="sumbit-fields space-between" layout="row" layout-sm="column">
					<div class="captcha" flex="33" flex-sm="100"></div>
					<div flex="66" flex-sm="100">
						<div layout="row" class="space-between">
							<md-button type="submit" class="md-raised" flex="49">Enviar</md-button>
							<div flex="49" class="check">
								<md-checkbox name="check" value="1" aria-label="Checkbox 1">*Quiero que mi nombre se publique junto con mi comentario</md-checkbox>
							</div>
						</div>
						<div class="msg">
							<p>*Tu correo electronico NO aparecerá con tu comentario.</p>
							<p>Si no quieres que tu comentario se publique en el perfil de la escuela, escribenos a:contacto@mejoratuesceual.org</p>
						</div>
					</div>
				</div>
			</div>
		</form>
	    <md-tabs class="tabs-data" md-selected="selectedData">
	    	<md-tab class="desempeno-tab" aria-controls="tab1-content">
	        	Desempeño<br/>academico
	      	</md-tab>
	      	<md-tab class="infraestructura-tab" aria-controls="tab2-content">
	        	Infraestructura<br/>escolar
	      	</md-tab>
	      	<md-tab class="comentarios-tab" aria-controls="tab2-content">
	        	Comentarios y<br/>reportes
	      	</md-tab>
	    </md-tabs>

	    <ng-switch on="selectedData" class="tabpanel-container">
	        <div role="tabpanel" class="desempeno" id="profile-content" aria-labelledby="tab1" ng-switch-when="0">
				<h2>Desempeño Académico Matutino</h2>
				<div class="block" layout="row" layout-sm="column" layout-margin layout-fill layout-padding>
					<div flex>
						<div layout="row">
							<div flex="70"><p>Número de alumnos evaluados</p></div>
							<div flex="30" class="number"><p><?=$this->escuela_per_turno->total_evaluados?></p></div>
						</div>
					</div>
					<div flex>
						<div layout="row">
							<div flex="70"><p>Porcentaje de alumnos en nivel reprobatorio</p></div>
							<div flex="30" class="number"><p><?=$this->escuela_per_turno->pct_reprobados?>%</p></div>
						</div>
					</div>								
				</div>
				<div class="chart-block mate" layout="row">
					<div class="purple" flex="25">
						<p class="i-cont"><i class="icon-calculadora-01"></i></p>
						<p>Resultados</p>
						<p>ENLACE</p>
						<div class="label"><p>Matemáticas</p></div>
					</div>
					<div flex="75" class="chart">

						<?php
			                                echo "<div id='line-chart-data-matematicas' class='hidden'>".json_encode($this->escuela_per_turno->chart_ma)."</div><div id='profile-line-chart-matematicas' class='chart'></div>";
						
						?>

					
					</div>
				</div>
				<div class="chart-block espanol" layout="row">
					<div class="purple" flex="25">
						<p class="i-cont"><i class="icon-enlace-01"></i></p>
						<p>Resultados</p>
						<p>ENLACE</p>
						<div class="label"><p>Español</p></div>
					</div>
					<div flex="75" class="chart">
						<?php 
			                                echo "<div id='line-chart-data-espaniol' class='hidden'>".json_encode($this->escuela_per_turno->chart_es)."</div><div id='profile-line-chart-espaniol' class='chart'></div>";
						
						?>
					</div>
				</div>
			</div>
	        <div role="tabpanel" class="infraestructura tables-box" id="profile-content" aria-labelledby="tab1" ng-switch-when="1">
				<h2>Infraestructura escolar <span>Información correspondiente al ciclo 2013/2014</span></h2>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-instalaciones-01"></i></div>
					<div flex="65" flex-sm="65"><p>Instalaciones</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<tr><td>Aulas para clase</td><td>12</td></tr>
					<tr><td>Áreas deportivas o recreativas</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Patio o plaza cívica</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Sala de computo</td><td>0</td></tr>
					<tr><td>Cuartos para baño o sanitarios</td><td>8</td></tr>
					<tr><td>Tazas sanitarios</td><td>17</td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-servicios-01"></i></div>
					<div flex="65" flex-sm="65"><p>Servicios</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<tr><td>Energia eléctrica</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Servicio de agua de la red pública</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Drenaje</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Cisterna o alijibe</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Servicio de internet</td><td><i class="icon-tache-01"></i></td></tr>
					<tr><td>Télefono</td><td><i class="icon-check-01"></i></td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-seguridad-01"></i></div>
					<div flex="65" flex-sm="65"><p>Seguridad</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<tr><td>Señales de protección civil</td><td><i class="icon-tache-01"></i></td></tr>
					<tr><td>Rutas de evacuación</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Salidas de emergencia</td><td><i class="icon-check-01"></i></td></tr>
					<tr><td>Zonas de seguridad</td><td><i class="icon-tache-01"></i></td></tr>
				</table>
			</div>
	        <div role="tabpanel" class="comentarios tables-box" id="profile-content" aria-labelledby="tab1" ng-switch-when="2">
				<h2>Comentarios</h2>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-estrella-01"></i></div>
					<div flex="90" flex-sm="85"><p>Calificación global de la escuela según usuarios</p></div>
				</div>
				<table>
					<tr><td>Calificación global</td><td>10.0</td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-pregunta-01"></i></div>
					<div flex="90" flex-sm="85"><p>Calificación promedio por pregunta</p></div>
				</div>
				<table>
					<tr><td>Preparación de maestros</td><td>10.0</td></tr>
					<tr><td>Asistencia de los maestros</td><td>10.0</td></tr>
					<tr><td>Relación con los padres de familia</td><td>10.0</td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-comentario2-01"></i></div>
					<div flex="90" flex-sm="85"><p>Calificación promedio por pregunta</p></div>
				</div>
				<ul class="comments-list">
					<li>
						<p><strong class="green">Calificación: 10 | </strong>Felipe (Padre de familia)</p>
						<p>14 Ago 2014</p>
						<p>La verdad es que esta escuela me parece de las mejores, muy recomendado</p>
					</li>
					<li>
						<p><strong class="green">Calificación: 10 | </strong>Felipe (Padre de familia)</p>
						<p>14 Ago 2014</p>
						<p>La verdad es que esta escuela me parece de las mejores, muy recomendado</p>
					</li>
					<li>
						<p><strong class="green">Calificación: 10 | </strong>Felipe (Padre de familia)</p>
						<p>14 Ago 2014</p>
						<p>La verdad es que esta escuela me parece de las mejores, muy recomendado</p>
					</li>
				</ul>
			</div>
		</ng-switch>
		<div class="compare-table">
			<table class="footable">
				<thead>
					<tr>
						<th class="footable-first-column">Escuelas similares</th>
						<th data-hide="phone">Nivel Escolar</th>
						<th data-hide="phone">Turno</th>
						<th data-hide="phone">Privada/publica</th>
						<th class="footable-last-column">Semáforo Educativo</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<strong>Jean Piaget</strong>
							<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
							<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
						</td>
						<td>Primaria</td>
						<td>Matutino</td>
						<td>Privada</td>
						<td>
							<md-button class="md-fab rank1" aria-label="Time"><i class="icon-tache-01"></i></md-button>
							<p>Excelente</p>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Jean Piaget</strong>
							<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
							<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
						</td>
						<td>Primaria</td>
						<td>Matutino</td>
						<td>Privada</td>
						<td>
							<md-button class="md-fab rank2" aria-label="Time"><i class="icon-check-01"></i></md-button>
							<p>Bien</p>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Jean Piaget</strong>
							<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
							<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
						</td>
						<td>Primaria</td>
						<td>Matutino</td>
						<td>Privada</td>
						<td>
							<md-button class="md-fab rank3" aria-label="Time"><i class="icon-check-01"></i></md-button>
							<p>De panzazo</p>
						</td>
					</tr>
					<tr>
						<td>
							<strong>Jean Piaget</strong>
							<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
							<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
						</td>
						<td>Primaria</td>
						<td>Matutino</td>
						<td>Privada</td>
						<td>
							<md-button class="md-fab rank4" aria-label="Time"><i class="icon-tache-01"></i></md-button>
							<p>Reprobado</p>
						</td>
					</tr>
				</tbody>
			</table>
			<a href="#" class="compare-button">COMPARAR</a>
			<div class="pagination">
				<a href="#">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">&gt;</a>
				<a href="#">ULTIMAS &gt;</a>
			</div>
			<div class="clear"></div>	
		</div>

	</div>
	<div flex="25" flex-sm="100" class="sidebar">
		<div class="box-yesno ">
			<p><i class="icon-familia-01"></i></p>
			<p>¿Cuenta con Asociación de padres de familia?</p>
			<div class="yes on"><span class="circle"></span>Sí</div>
			<div class="no"><span class="circle"></span>No</div>
		</div>
		<div class="box-yesno orange">
			<p><i class="icon-desk-01"></i></p>
			<p>¿Cuenta con Consejo de participacion social?</p>
			<div class="yes on"><span class="circle"></span>Sí</div>
			<div class="no"><span class="circle"></span>No</div>
		</div>
		<div class="box-yesno green">
			<p>¿Esta escuela fue censada?</p>
			<div class="yes on"><span class="circle"></span>Sí</div>
			<div class="no"><span class="circle"></span>No</div>
		</div>
		<div class="programs">
			<h5>Programas Federales</h5>
			<ul>
				<li layout="row">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuela Segura</div>
				</li>
				<li layout="row" class="on">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuelas de Calidad</div>
				</li>
				<li layout="row">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuelas de Tiempo Completo</div>
				</li>
				<li layout="row" class="on">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Sistema de Alerta Temprana</div>
				</li>
				<li layout="row">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuelas dignas</div>
				</li>
			</ul>
		</div>
		<div class="programs">
			<h5>Programas Federales</h5>
			<ul>
				<li layout="row">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuela Segura</div>
				</li>
				<li layout="row" class="on">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuelas de Calidad</div>
				</li>
				<li layout="row">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuelas de Tiempo Completo</div>
				</li>
				<li layout="row" class="on">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Sistema de Alerta Temprana</div>
				</li>
				<li layout="row">
					<div flex="25"><i class="icon-"></i></div><div flex="75">Programa Escuelas dignas</div>
				</li>
			</ul>
		</div>
	</div>
</div>


