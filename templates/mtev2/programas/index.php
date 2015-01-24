<div class="container programa">
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Programas</a>
		<a href="#">Programa escuela segura</a>
	</div>
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="75" flex-sm="100" class="programa-content">
			<div layout="row" class="title">
				<div class="programa-thumb" flex="20">
					<img src="/templates/mtev2/img/programas/12.jpg" alt="">
				</div>
				<div flex="10" class="icon-container" hide-sm>
					<div class="icon-wrapper vertical-align-center horizontal-align-center">
						<i class="icon-programas"></i>
					</div>
				</div>
				<div flex="70">
					<h1><strong>Programa escuela segura</strong></h1>
					<p><strong>Tema especifico que atiende el programa: Seguridad escolar</strong></p>				
				</div>
			</div>
			<div class="description">
				<h3 class="title">Descripción del programa</h3>
				<div class="text">
					<p>El programa otorga apoyo económico y técnico a las escuelas participantes que podrán invertir en: -Materiales educativos sobre gestión de la seguridad escolar. -Asesoría y acompañamiento sobre el tema. - Promoción de espacios de diálogo para fomentar la participación social en favor de la seguridad escolar. -Acciones de difusión sobre prevención y seguridad escolar. - Actividades de capacitación y enseñanza sobre prevención y seguridad escolar. -Compra de insumos de seguridad (por ejemplo, cámaras de vigilancia).</p>
				</div>
				<h3 class="title">¿Qué debe hacer una escuela que está interesada en participar en el proyecto?</h3>
				<div class="text">
					<p>Las escuelas deben ubicarse en los municipios que las autoridades señalen como de atención prioritaria. Si la escuela no se encuentra en alguno de estos pero desea participar, deben canalizar su petición a través del Consejo Escolar de Participación Social o la autoridad de la escuela.</p>
				</div>
				<div class="title web-page" layout="row">
					<div flex="10" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-share-01"></i>
						</div>
					</div>
					<div flex="90">
						<h3>Página web del programa <a href="#" target="_blank" class="light">http://basica.sep.gob.mx/escuelasegura/</a></h3>			
					</div>					
				</div>
				<div class="title" layout="row">
					<div flex="10" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-telefono-01"></i>
						</div>
					</div>
					<div flex="90">
						<h3>Contácto</h3>			
					</div>					
				</div>
				<div class="text">
					<p>36 01 60 00 (Ciudad de México) 01 800 767 8368	|	|36 01 60 00 (Ciudad de México) o desde los Estados al 01 800 767 8368 o vía correo electrónico: quejas@sep.gob.mx con copia para escuelasegura@sep.gob.mx</p>
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
				</div>
			</div>
		</div>
		<div flex="25" flex-sm="100" class="sidebar">
			<div class="programs">
				<h5>Programas federales</h5>
				<ul>
					<?php
					foreach($this->programas_federales as $programa){
					?>
						<li layout='row' <?=isset($this->escuela->programas[$programa->m_collection])?"class='on'":""?>>
			
							<div flex="25"><i class="icon-"></i></div><div flex="75"><?=$programa->nombre?></div>
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
			
							<div flex="25"><i class="icon-"></i></div><div flex="75"><?=$programa->nombre?></div>
						</li>
					<? } ?>
				</ul>
			</div>
		</div>
	</div>
</div>