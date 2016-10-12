<?php $controles = array(1=>'Pública', 2=>'Privada'); 
//share
$url_logo = $this->config->http_address."templates/".$this->config->theme."/img/logo_mejora.png";
$url = $this->config->http_address.$this->location;
$url = $url."/index/".$this->get('id');
$title = "El perfil de ".$this->capitalize($this->escuela->nombre);
$description = $title;
$urlFb = $url."#facebook";
$urlTwitter = $url."#twitter";
$urlMail = $url."#mail";
if($this->escuela->nivel->id == 11){
	$num_alumnos = $this->escuela->censo['num_alumnos']?$this->escuela->censo['num_alumnos']:'N/D';
	$num_personal = $this->escuela->censo['num_personal']?$this->escuela->censo['num_personal']:'N/D';
	$num_grupos = $this->escuela->censo['num_grupos']?$this->escuela->censo['num_grupos']:'N/D';
}else{
	$num_alumnos = $this->escuela_per_turno->censo?$this->escuela_per_turno->censo->alumnos:'N/D';
	$num_personal = $this->escuela_per_turno->censo?$this->escuela_per_turno->censo->personal:'N/D';
	$num_grupos = $this->escuela_per_turno->censo?$this->escuela_per_turno->censo->grupos:'N/D';
}
?>

<div class="space-between" layout="row" layout-sm="column">
	<div class="main-info" flex="70" flex-sm="100">
		<div layout="row" layout-sm="column">
			<leaflet ng-if="showEnlace" id="map" center="center" markers="markers"  layers="layers" flex="50" flex-sm="100"
            ng-init='loadMap(<?=json_encode($this->escuelas_digest)?>,"<?=$this->escuela->cct?>")'></leaflet>	
			<leaflet ng-if="showPlanea" id="map" center="center" markers="markers"  layers="layers" flex="50" flex-sm="100"
            ng-init='loadMap(<?=json_encode($this->escuelas_digest)?>,"<?=$this->escuela->cct?>", "planea")'></leaflet>	
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
					<a href="califica_tu_escuela/califica/<?=$this->escuela->cct?>" class="full-size-link"></a>
				</div>
				<div class="block school-banner-form">
					<ul>
						<li>Clave: <?=$this->escuela->cct?></li>
						<li>Nivel: <?=$this->capitalize($this->escuela->nivel->nombre)?></li>
						<li>Turno: <?=$this->capitalize($this->escuela->turno->nombre)?></li>
						<li><?=$controles[$this->escuela->control->id]?></li>
						<li>Teléfonos: <?=$this->escuela->telefono?></li>
						<?php if(isset($this->escuela->correoelectronico) && $this->escuela->correoelectronico){?>
							<li>Correo electrónico: <?=$this->escuela->correoelectronico?> </li>
						<?php } ?>
						<?php if(isset($this->escuela->paginaweb) && $this->escuela->paginaweb){?>
							<li>Sitio web: <?=$this->escuela->paginaweb?> </li>
						<?php } ?>
					</ul>




					<?php 
					$educaccion = isset($this->escuela->programas["educaccion"]);
					if($educaccion){
					?>
						<div layout="column">
							<div class="school-banner-content">
								<a href="http://convocatoriaeducaccion.mejoratuescuela.org/" class="full-size-link"></a>
								<div class="school-banner">
									<img src="/templates/mtev2/img/programas/29.png" alt="">
								</div>
								<p>Escuela <br> participante</p>
							</div>
						</div>
					<?php } ?>
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
							<h3 class="h3-icono-turno"><i class="icon-alumnos"></i></h3>
						</div>
						<div class="text-datos"><h3 class="h3-text-datos">Número de alumnos</h3></div>
						<div class="num-datos"><h3 class="h3-num-datos"><?=$num_alumnos?></h3></div>
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
						<div class="num-datos"><h3 class="h3-num-datos"><?=$num_personal?></h3></div>
					</div>
				</div>
			</div>
			<div class="datos-counters-3" flex="100">
				<div class="cont-datos">
					<div class="seccion-datos">
						<div class="icono-datos">
							<h3 class="h3-icono-turno"><i class="icon-escritorio-01"></i></h3>
						</div>
						<div class="text-datos"><h3 class="h3-text-datos">Grupos</h3></div>
						<div class="num-datos"><h3 class="h3-num-datos"><?=$num_grupos?></h3></div>
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

       		
		<!--
			<a href="http://www.mejoratuescuela.com/ventanilla-escolar/#/" class="ventanilla-big" layout="row" layout-align="center center">
                <p flex="50" class="msg">
                
                    ¿Buscas información para resolver una problemática en esta escuela?
                    <br>
                    <span>Encuéntrala en:</span>
                
                </p>
                <span class="ventanilla" flex="40">
    				<p>Ventanilla <span class="blue">Escolar</span></p>
	    			<p class="sub">
		    			<span class="de">de</span>
			    		<img src="/templates/mtev2/img/ventanilla.png" alt="">		
				    </p>
                </span>
			</a>
			-->


		<div class="mte-califica-form" mte-califica></div>
	</div>
	<?php if($this->escuela->nivel->nombre == 'PREESCOLAR'){ ?>
	<div flex="25" class="semaphore" flex-sm="100">
		<div class="section-image">
			<img src="/templates/mtev2/img/cubitos.png" alt="Preescolar">			
		</div>
		<div class="share_options">
			<div class="options space-between" layout="row" layout-md="column">
				<div flex="49" class="option">
						<p><i class="icon-print-01"></i></p>
						<p ng-click="print();">Imprimir</p>
				</div>
				<div flex="49" class="option" ng-click="show_share = !show_share">
					<span>
						<p><i class="icon-share-01"></i></p>
						<p>Compartir</p>
						</span>
				</div>
			</div>
			<div  class="share_show" layout="row" layout-md="column" ng-show="show_share">
				<div flex="30" class="share_fb">
					<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?=$urlFb?>&p[images][0]=<?=$url_logo?>&p[title]=<?=$title?>&p[summary]=<?=$description?>" target='_blank'>
						<i class="icon-fb-01"></i>
					</a>
			
				</div>
				<div flex="30" class="share_twitter"> 
					<a href="http://twitter.com/home?status=<?=$title." ".$urlTwitter," por @mejoratuescuela"?> " target='_blank' >
						<i class="icon-twitter-01-01"></i>
				
					</a>		
				</div>
				<div flex="30" class="share_email">
					<a href="mailto:?subject=<?=$title?>&amp;body=<?=$description.": ".$urlMail?>" target='_blank'>
						<i class="icon-mail-01"></i>
				
					</a>		
				</div>
			</div>
		</div>
	</div>	
	<?php 
		}else{
	?>
	<div class="semaphore" flex="30" flex-sm="100">
		<div layout="row" class="planea-enlace-buttons">
			<md-button flex ng-click="showEnlace = false; showPlanea = true;" ng-class="showPlanea?'to-planea show-type-data':'to-planea'">PLANEA</md-button>	
			<md-button flex ng-click="showPlanea = false; showEnlace = true;" ng-class="showEnlace?'to-enlace show-type-data':'to-enlace'">ENLACE</md-button>	
		</div>
		<h4>Semáforo educativo</h4>
		<div ng-show="showPlanea">
			<?php $this->escuela_per_turno->current_semaforo = $this->escuela_per_turno->planea_semaforo;
			$this->include_template('semaphore','escuelas'); ?>
		</div>
		<div ng-show="showEnlace">
			<?php $this->escuela_per_turno->current_semaforo = $this->escuela_per_turno->semaforo;
			$this->include_template('semaphore','escuelas'); ?>
		</div>


		<div class="adsbygoogle-content">
			<!-- School Profile Page Right Side 300 x 250 -->
			<ins class="adsbygoogle"
				style="display:inline-block;width:300px;height:250px"
				data-ad-client="ca-pub-5016039473129201"
				data-ad-slot="2015297378"
				<?php if ( !isset($this->config->ad_mode_test) || $this->config->ad_mode_test ) {?>
					data-ad-test="on"
				<?php } ?>
				>
			</ins>
			
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
		    	</script>
		
		</div>



		

	</div>
	<?php } ?> 
</div>
<div class="additional-info space-between" layout="row" layout-sm="column">
	<div class="data" flex="73" flex-sm="100">

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
			<div layout="row" class="planea-enlace-buttons">
				<md-button flex ng-click="showEnlace = false; showPlanea = true;" ng-class="showPlanea?'to-planea show-type-data':'to-planea'">PLANEA</md-button>
				<md-button flex ng-click="showPlanea = false; showEnlace=true;" ng-class="showEnlace?'to-enlace show-type-data':'to-enlace'">ENLACE</md-button>	
			</div>

			<!--PLANEA -->
			<div class="block" layout="row" layout-sm="column" layout-margin layout-fill layout-padding ng-if="showPlanea">
				<div flex>
					<div layout="row">
						<div flex="70"><p>Número de alumnos evaluados</p></div>
						<div flex="30" class="number"><p><?=$this->escuela_per_turno->planea_evaluados?></p></div>
					</div>
				</div>
				<!--
				<div flex>
					<div layout="row">
						<div flex="70"><p>Porcentaje de alumnos en nivel reprobatorio</p></div>
						<div flex="30" class="number"><p><?=$this->escuela_per_turno->pct_reprobados?>%</p></div>
					</div>
				</div>								
				-->
			</div>

			<!--Enlace -->

			<div class="block" layout="row" layout-sm="column" layout-margin layout-fill layout-padding ng-if="showEnlace">
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


			<div class="show-type-data-planea" ng-show="showPlanea">
				<div class="chart-block planea mate" layout="row" layout-sm="column">
					<div class="purple" flex="25" flex-sm="100">
						<p class="i-cont"><i class="icon-calculadora-01"></i></p>
						<p>Resultados</p>
						<p>PLANEA</p>
						<div class="label"><p>Matemáticas</p></div>
					</div>
					<div flex="75" flex-sm="100" class="chart" 
					ng-init='chart_planea[<?=$this->escuela_per_turno_index?>].matematicas=<?=json_encode($this->escuela_per_turno->chart_planea_ma)?>'
					>
						<div id='planea-profile-line-chart-matematicas' class="content_chart"></div>
			                        <div class="legend_chart">
			                            <div class="wrap_lc">

							<span class="planea_nacional circle"></span>
			                                <p class="planea_nacional">
								Promedio nacional
							</p>
							<span class="planea_estatal circle"></span>
			                                <p class="planea_estatal">
								Promedio estatal
							</p>
			                            </div>
			                        </div>
					
					</div>
				</div>
	
				<div class="chart-block planea espaniol" layout="row" layout-sm="column">
					<div class="purple" flex="25" flex-sm="100">
						<p class="i-cont"><i class="icon-enlace-01"></i></p>
						<p>Resultados</p>
						<p>PLANEA</p>
						<div class="label"><p>Español</p></div>
					</div>
					<div flex="75" flex-sm="100" class="chart" 
					ng-init='chart_planea[<?=$this->escuela_per_turno_index?>].espaniol=<?=json_encode($this->escuela_per_turno->chart_planea_es)?>'
					>
						<div id='planea-profile-line-chart-espaniol' class="content_chart"></div>
			                        <div class="legend_chart">
			                            <div class="wrap_lc">
							<span class="planea_nacional circle"></span>
			                                <p class="planea_nacional">
								Promedio nacional
							</p>

							<span class="planea_estatal circle"></span>
			                                <p class="planea_estatal">
								Promedio estatal
							</p>
			                            </div>
						</div>
					
					</div>
			    </div>
			</div>

			<div class="show-type-data-enlace" ng-show="showEnlace">
				<div class="chart-block mate" layout="row" layout-sm="column">
					<div class="purple" flex="25" flex-sm="100">
						<p class="i-cont"><i class="icon-calculadora-01"></i></p>
						<p>Resultados</p>
						<p>ENLACE</p>
						<div class="label"><p>Matemáticas</p></div>
					</div>
					<div flex="75" flex-sm="100" class="chart" 
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
				<div class="chart-block espanol" layout="row" layout-sm="column">
					<div class="purple" flex="25" flex-sm="100">
						<p class="i-cont"><i class="icon-enlace-01"></i></p>
						<p>Resultados</p>
						<p>ENLACE</p>
						<div class="label"><p>Español</p></div>
					</div>
					<div flex="75" flex-sm="100" class="chart"
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
			

			
		</div>
        
        <div class="infraestructura tables-box" id="infraestructura">
			<?php if(isset($this->escuela->censo) && ($infra = $this->escuela->censo['infraestructura'])){  
				$check = 'icon-check-01';
				$uncheck = 'icon-tache-01';
			?>
				<h2>Infraestructura escolar <span>Información correspondiente al ciclo 2013/2014</span></h2>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="10" class="i-cont"><i class="icon-instalaciones-01"></i></div>
					<div flex="65" flex-sm="65"><p>Instalaciones</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<tr><td>Aulas para clase</td><td><?=$infra['Aulas para impartir clase']?></td></tr>
					<?php $on = $infra['Áreas deportivas y recreativas'] ?>
					<tr><td>Áreas deportivas o recreativas</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Áreas deportivas y recreativas'] ?>
					<tr><td>Patio o plaza cívica</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>

					<tr><td>Sala de cómputo</td><td><?=$infra['Aulas de cómputo']?></td></tr>
					<tr><td>Cuartos para baño o sanitarios</td><td><?=$infra['Cuartos para baños o sanitarios']?></td></tr>
					<tr><td>Tazas sanitarias</td><td><?=$infra['Tazas sanitarias']?></td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="10" class="i-cont"><i class="icon-servicios-01"></i></div>
					<div flex="65" flex-sm="65"><p>Servicios</p></div>
					<div flex="25" flex-sm="25"><p>En esta escuela</p></div>
				</div>
				<table>
					<?php $on = $infra['Energía eléctrica'] ?>
					<tr><td>Energía eléctrica</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Servicio de agua de la red pública'] ?>
					<tr><td>Servicio de agua de la red pública</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Drenaje'] ?>
					<tr><td>Drenaje</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Cisterna o aljibe'] ?>
					<tr><td>Cisterna o aljibe</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Servicio de internet'] ?>
					<tr><td>Servicio de internet</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
					<?php $on = $infra['Teléfono'] ?>
					<tr><td>Teléfono</td><td><i class="<?=$on=='S'?$check:$uncheck?>"></i></td></tr>
				</table>
				<div class="table-top" layout="row">
					<div flex="10" flex-sm="10" class="i-cont"><i class="icon-seguridad-01"></i></div>
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
			$pro = "n/a";
			if(isset($this->preguntas) && count($this->preguntas)){
				$sm = 0;
				$l = 0;
				foreach($this->preguntas as $pregunta){
					if(!isset($pregunta->promedio))
						continue;
					$sm += $pregunta->promedio;
					$l++;
				}
				if($l != 0){
					$pro = $sm / $l;
					$pro = number_format($pro,2);		
				}

			}else{//Ya no deberia de venir asi.
				$cp = 0;
				$pt = 0;
				if(isset($this->escuela->calificaciones)){
					foreach($this->escuela->calificaciones as $calificacion){
						if(isset($calificacion->calificacion)){
							$cp++;
							$pt += $calificacion->calificacion;
						}
					}
					$pro = $cp>0?$pt/$cp:0;
					$pro = number_format($pro,2);
				}else{
					$pro = "n/a";
				}
			
			
			}
			?>

			<h2 layout="row" layout-sm="column">
				<div flex="50" flex-sm="100">Comentarios</div>
				<div flex="50" flex-sm="100">
					<div layout="row" class="total" flex="100">
						<div flex="20" class="icon-box"><i class="icon-desk-01"></i></div>
						<div flex="60">Total de personas que evaluaron esta escuela</div>
						<div flex="100"><strong><?=isset($this->escuela->calificaciones)?count($this->escuela->calificaciones):0 ?></strong></div>
				</div>
			</h2>
			<div class="table-top" layout="row">
				<div flex="10" flex-sm="10" class="i-cont"><i class="icon-estrella-01"></i></div>
				<div flex="90" flex-sm="85"><p>Calificación global de la escuela según usuarios</p></div>
			</div>
			<table>
				<tr><td>Calificación global</td><td><?=$pro?></td></tr>
			</table>
			<div class="table-top" layout="row">
				<div flex="10" flex-sm="10" class="i-cont"><i class="icon-pregunta-01"></i></div>
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
				<div flex="10" flex-sm="10" class="i-cont"><i class="icon-comentario2-01"></i></div>
				<div flex="90" flex-sm="85"><p>Calificación promedio por pregunta</p></div>
			</div>

			<?php if(isset($this->escuela->calificaciones)){?>
			<ul class="comments-list">
				<?php 
				foreach($this->escuela->calificaciones as $calificacion){
					if(isset($calificacion->activo) && $calificacion->activo && $calificacion->comentario!='_optional'){
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
		<div mte-ng-search
			class="compare-table" 
			show-search='false' 
			params='relatedSchoolParams' 
			table-title='Escuelas similares'>
		</div>

	</div>
	<div flex="30" flex-sm="100" class="sidebar">



		<div class="share_options">
			<div class="options space-between" layout="row" layout-md="column">
				<div flex="49" class="option">
						<p><i class="icon-print-01"></i></p>
						<p ng-click="print();">Imprimir</p>
				</div>
				<div flex="49" class="option" ng-click="show_share = !show_share">
					<span>
						<p><i class="icon-share-01"></i></p>
						<p>Compartir</p>
						</span>
				</div>
			</div>
			<div  class="share_show" layout="row" layout-md="column" ng-show="show_share">
				<div flex="30" class="share_fb">
					<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?=$urlFb?>&p[images][0]=<?=$url_logo?>&p[title]=<?=$title?>&p[summary]=<?=$description?>" target='_blank'>
						<i class="icon-fb-01"></i>
					</a>
			
				</div>
				<div flex="30" class="share_twitter"> 
					<a href="http://twitter.com/home?status=<?=$title." ".$urlTwitter," por @mejoratuescuela"?> " target='_blank' >
						<i class="icon-twitter-01-01"></i>
				
					</a>		
				</div>
				<div flex="30" class="share_email">
					<a href="mailto:?subject=<?=$title?>&amp;body=<?=$description.": ".$urlMail?>" target='_blank'>
						<i class="icon-mail-01"></i>
				
					</a>		
				</div>
			</div>
		</div>



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
				<?php 
				   $educaccion = isset($this->escuela->programas["educaccion"])? true:false;
				   if($educaccion){
				?>
       			             <span class="banner-school-osc"><li layout='row'class='on'>
						<div flex="25"><i class="icon-"></i></div>
						<div flex="75"><a href="http://convocatoriaeducaccion.mejoratuescuela.org/">Papás y mamás en EducAcción de Fundación Televisa</a></div>
					</li></span>
				<?php }else{ ?>
       			             <span class="banner-school-osc-not"><li layout='row'>
						<div flex="25"><i class="icon-"></i></div>
						<div flex="75"><a href="http://convocatoriaeducaccion.mejoratuescuela.org/">Papás y mamás en EducAcción de Fundación Televisa</a></div>
					</li></span>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
