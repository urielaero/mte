<div class='container compare compare-table' ng-controller="comparaCTL">
	<div class="adsbygoogle-content compara">
		<ins class="adsbygoogle"
			style="display:inline-block;width:728px;height:90px"
			data-ad-client="ca-pub-5016039473129201"
			<?php if ( !isset($this->config->ad_mode_test) || $this->config->ad_mode_test ) {?>
				data-ad-test="on"
			<?php } ?>
			data-ad-slot="3983054973"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>


	<div class="breadcrumb">
		<a href="/" class="start"><i class="icon-mejora"></i></a>
		<a href="/compara/escuelas/" id="ahref-breadcumb">Comparador</a>
	</div>
	<div ng-if="!escuelasResponse" id="message-not-found">
		<h2><strong>No has seleccionado escuelas para comparar</strong></h2>
		<!--<p>Te sugerimos primero buscar escuelas</p>-->
		<a href='' ng-click="toggleComparador()" class="search-schools"><strong>Buscar escuelas para comparar</strong></a>
	</div>
	<div layout='row' ng-show='loading && escuelasResponse' class='loader' layout-align='center center'>
		<md-progress-circular md-mode="indeterminate"  class="md-accent"></md-progress-circular>
	</div>
	<div ng-show='!loading'>	
		<div class="menu-top">
			<div class="tabs">
			    <md-tabs md-selected="selectedIndex">
			    	<md-tab class="general-tab" aria-controls="tab1-content" ga="'send', 'event', 'comparador', 'click', 'general'">
			    		<i class="icon-general-01"></i>
			    		<p>General</p>
			      	</md-tab>
			      	<md-tab class="results-tab" aria-controls="tab2-content" ga="'send', 'event', 'comparador', 'click', 'resultados-por-año'">
			      		<i class="icon-calendar"></i>
			      		<p>Resultados por año</p>
			      	</md-tab>
			    	<md-tab class="student-tab" aria-controls="tab1-content"  ga="'send', 'event', 'comparador', 'click', 'desempeño-por-alumno'">
			    		<i class="icon-student"></i>
			    		<p>Desempeño por alumno</p>
			      	</md-tab>
			      	<md-tab class="map-tab" aria-controls="tab2-content"  ga="'send', 'event', 'comparador', 'click', 'mapa'">
			      		<i class="icon-mapa"></i>
			      		<p>Mapa</p>
			      	</md-tab>
			    </md-tabs>
			</div>
		</div>
		<ng-switch on="selectedIndex" class="tabpanel-container">
			<div role="tabpanel" class="tab-content phone-content" aria-labelledby="tab1" ng-switch-when="0" md-swipe-left="next()" md-swipe-right="previous()" >
				<div class="compare-table general">
					<table class="footable">
						<thead>
							<tr>
								<th class="footable-first-column">Escuelas</th>
								<th data-hide="phone">Nivel</th>
								<th data-hide="phone">Turno matutino/vespertino</th>
								<th class="privadapublica">Privada pública</th>
								<th data-hide="phone">Posición estatal</th>
								<th class="footable-last-column">Semáforo de Resultados Educativos</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='escuela in escuelas'>
								<td>
									<a ng-href='/escuelas/index/{{escuela.cct}}'><strong ng-bind='escuela.nombre'></strong></a>
									<p><small><i class="icon-conoce-01"></i> {{escuela.localidad}}, {{escuela.entidad}}</small></p>
									<!--<p><small><i class="icon-enlace-01" ng-show='escuela.turno.nombre' ></i> {{escuela.turno.nombre}}</small></p>-->
								</td>
								<td>{{escuela.nivel}}</td>
								<td>{{escuela.turno.nombre.capitalize()}}</td>
								<td>{{escuela.control}}</td>
								<td><strong ng-bind='escuela.planea_rank_entidad || "--"'></strong> de <strong ng-bind='escuela.entidad_cct_count'></strong></td>
								<td>
							<!-- los iconos ya se alinean bien de esta forma si se cambia por md-button se desalinean Carlos Barahona-->
								<div id="boton-semaforo-compara" ng-class="semaforosPlanea[escuela.planea_semaforo].class" >
								  <div id="semaforos-buscador">
									<i id="semaforos-buscador-icono" ng-class="semaforosPlanea[escuela.planea_semaforo].icon"></i>
								  </div>
								</div>
							<!--Carlos Barahona-->
								<p>{{semaforosPlanea[escuela.planea_semaforo].label}}</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div role="tabpanel" class="tab-content phone-content" aria-labelledby="tab1" ng-switch-when="1" md-swipe-left="next()" md-swipe-right="previous()" >
				<div class="compare-table years">
					<table class="footable">
						<thead>
							<tr>

								<th class="footable-first-column">Escuelas</th>
								<th 
									data-hide="phone"
									ng-bind='year'
									ng-repeat='(key,year) in years'
									ng-class='key == years.length-1 ? "" : "footable-last-column"'>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='escuela in escuelas'>						
								<td>
									<a ng-href='/escuelas/index/{{escuela.cct}}'><strong ng-bind='escuela.nombre'></strong></a>
									<p><small><i class="icon-conoce-01"></i> {{escuela.localidad}}, {{escuela.entidad}}</small></p>
									<!--<p><small><i class="icon-enlace-01"></i> {{escuela.turno.nombre}}</small></p>-->
								</td>
								<td ng-repeat='year in years' ng-bind='escuela.avgs[year] || "--"'></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div role="tabpanel" class="tab-content phone-content" aria-labelledby="tab1" ng-switch-when="2" md-swipe-left="next()" md-swipe-right="previous()" >
				<div class="compare-table student-table">
					<table class="desemp">
						<thead>
							<tr>
								<th class="school" rowspan="2">Escuelas comparadas</th>
								<th colspan="4">Español</th>
								<th colspan="4">Matemáticas</th>
								<th rowspan="2" class="calificacion">Alumnos que tomaron la prueba</th>
							</tr>
							<tr>
								<th class="calificacion">
									<md-button class="md-fab rank1" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>Insuficiente</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank2" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>Indispensable</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank3" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Satisfactorio</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank4" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Sobresaliente</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank1" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>Insuficiente</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank2" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>Indispensable</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank3" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Satisfactorio</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank4" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Sobresaliente</p>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='escuela in escuelas'>
								<td class="school"><a ng-href="/escuelas/index/{{escuela.cct}}" ng-bind='escuela.nombre'></a></td>
								<td class="rank" ng-repeat='score in escuela.planea_espaniol_charts track by $index' ng-bind='score[1] + "%"' ng-if="score[1] != 'escuela'"></td>

								<!--<td class="rank" ng-repeat='score in escuela.stats[statsYear].mat track by $index' ng-bind='getPCT(score,escuela)'></td>-->
								<td class="rank" ng-repeat='score in escuela.planea_matematicas_charts track by $index' ng-bind='score[1] + "%"' ng-if="score[1] != 'escuela'"></td>
								<!--
								<td ng-show='!escuela.stats[statsYear].esp' ng-repeat='blank in ["--","--","--","--"] track by $index' ng-bind='blank'></td>
								<td ng-show='!escuela.stats[statsYear].mat' ng-repeat='blank in ["--","--","--","--"] track by $index' ng-bind='blank'></td>
								-->
								<td class="rank" ng-bind='escuela.planea_evaluados || "--"'></td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
			<div role="tabpanel" class="tab-content phone-content" aria-labelledby="tab1" ng-switch-when="3" md-swipe-left="next()" md-swipe-right="previous()" >
				<div id="map">
					<leaflet id="map" center="center" markers="markers" layers="layers"></leaflet>	
				</div>
			</div>
		</ng-switch>
	
	<!-- <div class="search-form">
		<form action="#">
			<div layout="row" class="space-between input-row" layout-sm="column">
				<div flex="30" flex-sm="100"><input type="text" placeholder="Nombre de la escuela"></div>
				<div flex="30" flex-sm="100"><select>
					<option value="">Estado</option>
				</select></div>
				<div flex="30" flex-sm="100"><select>
					<option value="">Municipio</option>
				</select></div>
			</div>
			<div layout="row" class="space-between input-row" layout-sm="column">
				<div flex="30" flex-sm="100"><select>
					<option value="">Nivel escolar</option>
				</select></div>
				<div flex="30" flex-sm="100"><select>
					<option value="">Publica | Privada</option>
				</select></div>
				<div flex="30" flex-sm="100"><select>
					<option value="">Localidad</option>
				</select></div>
			</div>
			<div class="space-between submit-row" layout="row" layout-sm="column">
				<input flex="48" flex-sm="100" type="submit" value="Buscar" class="s-btn">
				<a href="#" flex="48" flex-sm="100" class="s-btn green-button">Ver en mapa</a>
			</div>
		</form>
	</div> -->
		<a href="" ng-click='toggleComparador()' class="add-school">Agregar otra escuela</a>	
	</div>
</div>
