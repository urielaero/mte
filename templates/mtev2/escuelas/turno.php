<?php $controles = array(1=>'Pública', 2=>'Privada'); ?>
<div class="space-between" layout="row" layout-sm="column">
	<div class="main-info" flex="73" flex-sm="100">
		<div layout="row" layout-sm="column">
			<leaflet id="map" center="center" markers="markers"  flex="50"
            ng-init='loadMap(<?=json_encode($this->escuelas_digest)?>,"<?=$this->escuela->cct?>")'></leaflet>	
			<div class="info" flex="50" flex-sm="100">
				<div class="califica" layout="row">
					<div flex="35" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-califica2-01"></i>
						</div>
					</div>
					<div flex="65">
						<h4>Califica tu escuela</h4>
					</div>
					<a href="#" class="full-size-link"></a>
				</div>
				<div class="block">
					<ul>
						<li>Clave: <?=$this->escuela->cct?></li>
						<li>Nivel: <?=$this->capitalize($this->escuela->nivel->nombre)?></li>
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
		<!--Carlos Barahona-->
		<div class="cont-info-turno" layout="row" layout-sm="column" layout-md="column">
			<div class="datos-counters-1" flex="100">
				<div class="cont-datos">
					<div class="seccion-datos">
						<div class="icono-datos">
							<h3 class="h3-icono-turno"><i class="icon-numeroalumnos"></i></h3>
						</div>
						<div class="text-datos"><h3 class="h3-text-datos">Número de Alumnos</h3></div>
						<div class="num-datos"><h3 class="h3-num-datos"><?=$this->escuela_per_turno->total_evaluados?></h3></div>
					</div>
				</div>
			</div>
			<div class="datos-counters-2" flex="100">
				<div class="cont-datos">
					<div class="seccion-datos">
						<div class="icono-datos">
							<h3 class="h3-icono-turno"><i class="icon-personal"></i></h3>
						</div>
						<div class="text-datos"><h3 class="h3-text-datos">Total de personal</h3></div>
						<div class="num-datos"><h3 class="h3-num-datos"><?=$this->escuela_per_turno->total_evaluados?></h3></div>
					</div>
				</div>
			</div>
			<div class="datos-counters-3" flex="100">
				<div class="cont-datos">
					<div class="seccion-datos">
						<div class="icono-datos">
							<h3 class="h3-icono-turno"><i class="icon-grupos"></i></h3>
						</div>
						<div class="text-datos"><h3 class="h3-text-datos">Grupos</h3></div>
						<div class="num-datos"><h3 class="h3-num-datos"><?=$this->escuela_per_turno->total_evaluados?></h3></div>
					</div>
				</div>
			</div>
		</div>
		<!--Carlos Barahona-->
		<!--<div class="counters " layout="row" layout-sm="column">
			<div class="cont-counters">
				
			</div>
			<div flex><div layout="row">
				<div flex class="icon-box"><i class="icon-familia-01"></i></div>
				<div flex>Número de alumnos:</div>
				<div flex class="number"><?=$this->escuela_per_turno->total_evaluados?></div>
			</div></div>
			<div flex><div layout="row">
				<div flex class="icon-box small"><i class="icon-desk-01"></i></div>
				<div flex>Total de personas:</div>
				<div flex class="number"><?=$this->escuela_per_turno->total_evaluados?></div>
			</div></div>
			<div flex><div layout="row">
				<div flex class="icon-box small"><i class="icon-desk-01"></i></div>
				<div flex>Grupos:</div>
				<div flex class="number"><?=$this->escuela_per_turno->total_evaluados?></div>
			</div></div> 
		</div>-->
	</div>
	<?php if($this->escuela->nivel->nombre == 'PREESCOLAR'){ ?>
	<div flex="25" class="semaphore" flex-sm="100">
		<div class="section-image">
			<img src="/templates/mtev1/img/cubitos.png" alt="Preescolar">			
		</div>
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

		<?php if($this->escuela->infraestructura): ?>
		    <div layout="row" class="scroll-links space-between">
		    	<a href="#desempeno" ng-click="scrollTo('desempeno',$event)" class="link desempeno-tab" flex="32">Desempeño<br/>académico</a>
		    	<a href="#infraestructura" ng-click="scrollTo('infraestructura',$event)" class="link infraestructura-tab" flex="32">Infraestructura<br/>escolar</a>
		    	<a href="#comentarios" ng-click="scrollTo('comentarios',$event)" class="link comentarios-tab" flex="32">Comentarios y<br/>reportes</a>
		    </div>	
		<?php else: ?>	
		    <div layout="row" class="scroll-links space-between">
		    	<a href="#desempeno" ng-click="scrollTo('desempeno',$event)" class="link desempeno-tab" flex="48">Desempeño<br/>académico</a>
		    	<a href="#comentarios" ng-click="scrollTo('comentarios',$event)" class="link comentarios-tab" flex="48">Comentarios y<br/>reportes</a>
		    </div>		
		<?php endif; ?>


        <div  class="desempeno" id="desempeno">
			<h2>Desempeño académico matutino</h2>
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
				<div flex="75" class="chart" 
				ng-init='chart[<?=$this->escuela_per_turno_index?>].matematicas=<?=json_encode($this->escuela_per_turno->chart_ma)?>'
				>
					<div id='profile-line-chart-matematicas' class="content_chart"></div>
		                        <div class="legend_chart">
		                            <div class="wrap_lc">
		                                <p ng-repeat="year in chart[<?=$this->escuela_per_turno_index?>].matematicas[0]" ng-if="year!='Año'">
							<span class="circle" style='background:{{chart_colors[$index-1]}}'></span>
							{{year}}
						</p>
		                            </div>

		                            <p class="under">_ _ _ _</p>
		                            <p>Promedio nacional</p>
		                        </div>
				
				</div>
			</div>
			<div class="chart-block espanol" layout="row">
				<div class="purple" flex="25">
					<p class="i-cont"><i class="icon-enlace-01"></i></p>
					<p>Resultados</p>
					<p>ENLACE</p>
					<div class="label"><p>Español</p></div>
				</div>
				<div flex="75" class="chart"
				ng-init='chart[<?=$this->escuela_per_turno_index?>].espaniol=<?=json_encode($this->escuela_per_turno->chart_es)?>'
				>
					<div id='profile-line-chart-espaniol' class="content_chart"></div>
		                        <div class="legend_chart">
		                            <div class="wrap_lc">
		                                <p ng-repeat="year in chart[<?=$this->escuela_per_turno_index?>].espaniol[0]" ng-if="year!='Año'">
							<span class="circle" style='background:{{chart_colors[$index-1]}}'></span>
							{{year}}
						</p>
		                            </div>

		                            <p class="under">_ _ _ _</p>
		                            <p>Promedio nacional</p>
		                        </div>
				</div>
			</div>
		</div>
        
        <div class="infraestructura tables-box" id="infraestructura">
			<?php if(isset($this->escuela->censo) && ($infra = $this->escuela->censo['infraestructura'])){  
				$check = 'icon-check-01';
				$uncheck = 'icon-tache-01';
			?>
				<h2>Infraestructura escolar <span>Información correspondiente al ciclo 2013/2014</span></h2>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-instalaciones-01"></i></div>
					<div flex="65" flex-sm="65"><p>Instalaciones</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<tr><td>Aulas para clase</td><td><?=$infra['Aulas para impartir clase']?></td></tr>
					<?php $on = $infra['Áreas deportivas y recreativas'] ?>
					<tr><td>Áreas deportivas o recreativas</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Áreas deportivas y recreativas'] ?>
					<tr><td>Patio o plaza cívica</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>

					<tr><td>Sala de computo</td><td><?=$infra['Aulas de cómputo']?></td></tr>
					<tr><td>Cuartos para baño o sanitarios</td><td><?=$infra['Cuartos para baños o sanitarios']?></td></tr>
					<tr><td>Tazas sanitarios</td><td><?=$infra['Tazas sanitarias']?></td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-servicios-01"></i></div>
					<div flex="65" flex-sm="65"><p>Servicios</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<?php $on = $infra['Energía eléctrica'] ?>
					<tr><td>Energia eléctrica</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Servicio de agua de la red pública'] ?>
					<tr><td>Servicio de agua de la red pública</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Drenaje'] ?>
					<tr><td>Drenaje</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Cisterna o aljibe'] ?>
					<tr><td>Cisterna o alijibe</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Servicio de internet'] ?>
					<tr><td>Servicio de internet</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Teléfono'] ?>
					<tr><td>Télefono</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="15" class="i-cont"><i class="icon-seguridad-01"></i></div>
					<div flex="65" flex-sm="65"><p>Seguridad</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<?php $on = $infra['Señales de protección civil'] ?>
					<tr><td>Señales de protección civil</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Rutas de evacuación'] ?>
					<tr><td>Rutas de evacuación</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Salidas de emergencia'] ?>
					<tr><td>Salidas de emergencia</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Zonas de seguridad'] ?>
					<tr><td>Zonas de seguridad</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
				</table>

			<?php } ?>
		</div>

        <div  class="comentarios tables-box" id="comentarios">
			<?php
				$cp = 0;
				$pt = 0;
				if($this->escuela->calificaciones){
					foreach($this->escuela->calificaciones as $calificacion){
						if(isset($calificacion->calificacion)){
							$cp++;
							$pt += $calificacion->calificacion;
						}
					}
					$pro = $pt/$cp;
					$pro = number_format($pro,2);
				}else{
					$pro = "n/a";
				}
			?>

			<h2 layout="row">
				<div flex="50">Comentarios</div>
				<div flex="50">
					<div layout="row" class="total">
						<div flex="20" class="icon-box"><i class="icon-desk-01"></i></div>
						<div flex="60">Total de personas que evaluaron esta escuela</div>
						<div flex="20"><strong><?=isset($this->escuela->calificaciones)?count($this->escuela->calificaciones):0 ?></strong></div>
				</div>
			</h2>
			<div class="table-top" layout="row">
				<div flex="10" flex-sm="15" class="i-cont"><i class="icon-estrella-01"></i></div>
				<div flex="90" flex-sm="85"><p>Calificación global de la escuela según usuarios</p></div>
			</div>
			<table>
				<tr><td>Calificación global</td><td><?=$pro?></td></tr>
			</table>
			<div class="table-top" layout="row">
				<div flex="10" flex-sm="15" class="i-cont"><i class="icon-pregunta-01"></i></div>
				<div flex="90" flex-sm="85"><p>Calificación promedio por pregunta</p></div>
			</div>
			<table>
			<?php
			if($this->preguntas){
				foreach($this->preguntas as $pregunta){
					echo "<tr>
						<td>{$pregunta->titulo}</td>
						<td>".(isset($pregunta->promedio) ? $pregunta->promedio:"n/a")."</td>
					</tr>";
				}
			}
			?>
			</table>
			<div class="table-top" layout="row">
				<div flex="10" flex-sm="15" class="i-cont"><i class="icon-comentario2-01"></i></div>
				<div flex="90" flex-sm="85"><p>Calificación promedio por pregunta</p></div>
			</div>

			<?php if(isset($this->escuela->calificaciones)){?>
			<ul class="comments-list">
				<?php 
				foreach($this->escuela->calificaciones as $calificacion){
					if(isset($calificacion->activo) && $calificacion->activo){
						$coment = preg_replace('/\v+|\\\[rn]/','<br/>',$calificacion->comentario);
                			        $coment = stripslashes($coment);
						$text_calificacion = isset($calificacion->calificacion)?'<span>Calificación <br /> otorgada</span>':'';
						$ocupacion = $calificacion->ocupacion =='padredefamilia' || $calificacion->ocupacion == 'Padre de familia' ? 'Padre de familia':($this->capitalize($calificacion->ocupacion));
						$cali = $calificacion->calificacion;
						$cali = $cali > 10?$cali/10:$cali;//error cuendo en la db se calificaba de a 100
						$nombreCalificacion  = ($calificacion->acepta_nombre == 1) ? $calificacion->nombre : ''; 
						date_default_timezone_set('America/Mexico_City');
						$time = date("d M Y",strtotime($calificacion->timestamp));
						echo <<<EOD
				<li>
					<p><strong class="green">Calificación: {$cali} | </strong>{$nombreCalificacion} ({$ocupacion})</p>
					<p>{$time}</p>
					<p>{$calificacion->comentario}</p>
				</li>
EOD;
						}
					}
				
				?>
			</ul>
			<?php } ?>
		</div>

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
			<a href="#" class="compare-button">Comparar</a>
			<div class="pagination">
				<a href="#">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">&gt;</a>
				<a href="#">Últimas &gt;</a>
			</div>
			<div class="clear"></div>	
		</div>

	</div>
	<div flex="25" flex-sm="100" class="sidebar">
	<?php $censo_only = array('SECUNDARIA','PREESCOLAR','PRIMARIA');
	if(isset($this->escuela->censo) && in_array($this->escuela->nivel->nombre,$censo_only)){ ?>
		<div class="box-yesno ">
			<p><i class="icon-familia-01"></i></p>
			<p>¿Cuenta con Asociación de padres de familia?</p>
			<?php $on = $this->escuela->censo['infraestructura']['Asociación de padres de familia']; ?>
			<div class="yes <?=$on=='S'?'on':'';?>"><span class="circle"></span>Sí</div>
			<div class="no <?=$on!='S'?'on':'';?>"><span class="circle"></span>No</div>
		</div>
		<div class="box-yesno orange">
			<p><i class="icon-desk-01"></i></p>
			<p>¿Cuenta con Consejo de participacion social?</p>
			<?php $on = $this->escuela->censo['infraestructura']['Consejo de participación social']; ?>
			<div class="yes <?=$on=='S'?'on':'';?>"><span class="circle"></span>Sí</div>
			<div class="no <?=$on!='S'?'on':'';?>"><span class="circle"></span>No</div>
		</div>
		<div class="box-yesno green">
			<p>¿Esta escuela fue censada?</p>
			<?php $on = $this->escuela->censo['status'];?>
			<div class="yes <?=$on=='Censado'?'on':'';?>"><span class="circle"></span>Sí</div>
			<div class="no <?=$on!='Censado'?'on':'';?>"><span class="circle"></span>No</div>
		</div>
	<?php } ?>
		<div class="programs">
			<h5>Programas federales</h5>
			<ul>
				<?php
				foreach($this->programas_federales as $programa){
				?>
					<li layout='row' <?=isset($this->escuela->programas[$programa->m_collection])?"class='on'":""?>>
		
						<div flex="25"><i class="icon-"></i></div>
						<div flex="75"><a href="/programas/index/<?php echo $programa->id ?>"><?=$programa->nombre?></a></div>
					</li>
				<? } ?>
			</ul>
		</div>
		<div class="programs">
			<h5>Programas OSC's</h5>
			<ul>
				<?php
				foreach($this->programas_osc as $programa){
				?>
					<li layout='row' <?=isset($this->escuela->programas[$programa->m_collection])?"class='on'":""?>>
		
						<div flex="25"><i class="icon-"></i></div>
						<div flex="75"><a href="/programas/index/<?php echo $programa->id ?>"><?=$programa->nombre?></a></div>
					</li>
				<? } ?>
			</ul>
		</div>
	</div>
</div>