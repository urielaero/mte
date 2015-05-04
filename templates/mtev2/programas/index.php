<div class="container programa" ng-controller="programaCTL">
    <?php
    $estados_programa = array();
    foreach ($this->entidades as $key => $estado) {
        if(isset($this->programa->entidad_escuelas_count[$estado->id]) && $this->programa->entidad_escuelas_count[$estado->id] > 0){
        	$estado->count_participa = $this->programa->entidad_escuelas_count[$estado->id];
        	array_push($estados_programa, $estado);
        }
    }
   	$array_estados_js = json_encode($estados_programa);
    ?>
	<script type='text/javascript'>
	    window.entidadesParticipantes = <?= $array_estados_js?>;
	    window.programaId = <?php echo $this->programa->id ?>;
	</script>	
	<div class="breadcrumb">
		<a href="/" class="start"><i class="icon-mejora"></i></a>
		<a href="/mejora/programas">Programas</a>
		<a href="/programas/index/<?= $this->programa->id?>"><?=$this->programa->nombre?></a>
	</div>
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="75" flex-sm="100" class="programa-content">
			<?php
			$idImg = $this->get('id'); 
			$existsImg = file_exists($this->config->document_root."templates/mtev2/img/programas/{$idImg}.jpg");
			?>
			<div layout="row" class="title main-title">
				<?php if($existsImg){ ?>
				<div class="programa-thumb" flex="20">
					<img src="/templates/mtev2/img/programas/<?php echo $idImg ?>.jpg" alt="">
				</div>
				<?php } ?>
				<div flex="10" class="icon-container" hide-sm>
					<div class="icon-wrapper vertical-align-center horizontal-align-center">
						<i class="icon-programas"></i>
					</div>
				</div>
				<?php $flex = $existsImg ? '70' : '100' ?>
				<div flex="<?php echo $flex ?>">
				<?php 
					$datoExtra = "";
					if($this->programa->id==5) $datoExtra = " (datos del 2012)";
				 ?>
					<h1><strong><?php echo $this->programa->nombre.$datoExtra; ?></strong></h1>
					<p><strong>Tema específico que atiende el programa: <?php echo $this->programa->tema_especifico; ?></strong></p>				
				</div>
			</div>
			<div class="description">
				<h3 class="title">Descripción del programa</h3>
				<div class="text">
					<?php $desc = $this->programa->descripcion;?>
					<p><?=$this->programa->id==20?nl2br($desc):$desc; ?></p>
				</div>
				<h3 class="title">¿Qué debe hacer una escuela que está interesada en participar en el proyecto?</h3>
				<div class="text">
					<p><?php echo $this->programa->requisitos; ?></p>
				</div>
				<div class="title web-page" layout="row">
					<div flex="10" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-share-01"></i>
						</div>
					</div>
					<div flex="90">
						<h3>Página web del programa <a target="_blank" href="http://<?=$this->programa->sitio_web;?>" class="light" ><?php echo $this->programa->sitio_web; ?></a></h3>			
					</div>					
				</div>
				<div class="title" layout="row">
					<div flex="10" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-telefono-01"></i>
						</div>
					</div>
					<div flex="90">
						<h3>Contacto</h3>			
					</div>					
				</div>
				<div class="text">
					<p>
						<?php echo $this->programa->telefono; ?>
						|<?php echo $this->programa->telefono_contacto; ?>
						|<?php echo $this->programa->mail; ?>
					</p>
				</div>
				<div class="map-section">
					<div class="title" layout="row">
						<div flex="10" class="icon-container" hide-sm>
							<div class="icon-wrapper vertical-align-center horizontal-align-center">
								<i class="icon-mapa"></i>
							</div>
						</div>
						<div flex="90">
							<h3>Zonas de cobertura nacional</h3>			
						</div>					
					</div>
					<leaflet id="map" center="center" markers="markers" layers="layers" ng-init='loadMap(states)'></leaflet>										
				</div>
				<div id="escuelas-programas">
					<div>					
						<div id="titulo-escuelas-programas">
							<h6 class="titulo-escuelas-programas"><strong>Escuelas en donde está este programa.</strong>Ciclo escolar 2013 | 2014</h6>
						</div>
						<div id="programa-escuela" data-ng-repeat="escuela in escuelas">
							<h6 class="programa-escuelas"><a data-ng-href="/escuelas/index/{{escuela.cct}}">{{escuela.nombre}}</a></h6>
							<div class="datos-escuela-pro">
								<i class="icon-conoce-01 icon-direccion"></i><div class="direccion-escuela">{{escuela.municipio}}, {{capitalizeFirstLetter(currentState.name)}}</div>
							</div>
						</div>
					</div>
					<div class="loading-circle" data-ng-show="loading" layout='row' ng-show='true' flex flex-sm="100" layout-align='center center'>
						<md-progress-circular md-mode="indeterminate"></md-progress-circular>
					</div>
					<a data-ng-show="escuelas.length>0" href="" data-ng-click="loadEscuelasPorEntidad(currentState.id,currentState.name)" class="button-bordered show-more-btn">Ver más escuelas</a>
				</div>
			</div>
		</div>
		<div flex="25" flex-sm="100" class="sidebar trivial222">
			<div class="programs">
				<h5>Programas federales</h5>
				<ul>
					<?php
					foreach($this->programas_federales as $programa){
						$on = $programa->id == $this->programa->id ? 'on' : '';
					?>
						<li layout='row' class="<?php echo $on; ?>">
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
						$on = $programa->id == $this->programa->id ? 'on' : '';
					?>
						<li layout='row' class="<?php echo $on; ?>">
							<div flex="25"><i class="icon-"></i></div>
							<div flex="75"><a href="/programas/index/<?php echo $programa->id ?>"><?=$programa->nombre?></a></div>
						</li>
					<? } ?>
				</ul>
			</div>
		</div>
	</div>
</div>