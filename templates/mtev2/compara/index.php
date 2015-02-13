<div class='container compare' ng-controller="comparaCTL">
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
			    	<md-tab class="general-tab" aria-controls="tab1-content">
			    		<i class="icon-general-01"></i>
			    		<p>General</p>
			      	</md-tab>
			      	<md-tab class="results-tab" aria-controls="tab2-content">
			      		<i class="icon-calendar"></i>
			      		<p>Resultados por año</p>
			      	</md-tab>
			    	<md-tab class="student-tab" aria-controls="tab1-content">
			    		<i class="icon-student"></i>
			    		<p>Desempeño por alumno</p>
			      	</md-tab>
			      	<md-tab class="map-tab" aria-controls="tab2-content">
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
								<th data-hide="phone">Calificación español</th>
								<th data-hide="phone">Calificación matemáticas</th>
								<th data-hide="phone">Nivel escolar</th>
								<th data-hide="phone">Turno Matutino/Vespertino</th>
								<th class="privadapublica">Privada pública</th>
								<th>Posición estatal</th>
								<th class="footable-last-column">Semáforo educativo</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='escuela in escuelas'>
								<td>
									<a ng-href='/escuelas/index/{{escuela.cct}}'><strong ng-bind='escuela.nombre'></strong></a>
									<p><small><i class="icon-conoce-01"></i> {{escuela.localidad}}, {{escuela.entidad}}</small></p>
									<!--<p><small><i class="icon-enlace-01" ng-show='escuela.turno.nombre' ></i> {{escuela.turno.nombre}}</small></p>-->
								</td>
								<td ng-bind='escuela.promedio_espaniol || "--"'></td>
								<td ng-bind='escuela.promedio_matematicas || "--"'></td>
								<td>{{escuela.nivel}}</td>
								<td>{{escuela.turno.nombre.capitalize()}}</td>
								<td>{{escuela.control}}</td>
								<td><strong ng-bind='escuela.rank || "--"'></strong> de <strong ng-bind='escuela.entidad_cct_count'></strong></td>
								<td>
									<md-button id="boton-semaforo-compara" ng-class="semaforos[escuela.semaforo].class" class="md-fab" aria-label="Time">
										<i id="semaforos-buscador" ng-class="semaforos[escuela.semaforo].icon"></i>
									</md-button>
									<p>{{semaforos[escuela.semaforo].label}}</p>
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
								<th rowspan="2" class="calificacion">Muestras poco confiables</th>
							</tr>
							<tr>
								<th class="calificacion">
									<md-button class="md-fab rank1" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>Reprobado</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank2" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>De panzazo</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank3" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Bien</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank4" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Excelente</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank1" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>Reprobado</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank2" aria-label="Time"><i class="icon-tache-01"></i></md-button>
									<p>De panzazo</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank3" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Bien</p>
								</th>
								<th class="calificacion">
									<md-button class="md-fab rank4" aria-label="Time"><i class="icon-check-01"></i></md-button>
									<p>Excelente</p>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='escuela in escuelas'>
								<td class="school"><a ng-href="/escuelas/index/{{escuela.cct}}" ng-bind='escuela.nombre'></a></td>
								<td class="rank" ng-repeat='score in escuela.stats[statsYear].esp track by $index' ng-bind='getPCT(score,escuela)'></td>
								<td class="rank" ng-repeat='score in escuela.stats[statsYear].mat track by $index' ng-bind='getPCT(score,escuela)'></td>
								<td ng-show='!escuela.stats[statsYear].esp' ng-repeat='blank in ["--","--","--","--"] track by $index' ng-bind='blank'></td>
								<td ng-show='!escuela.stats[statsYear].mat' ng-repeat='blank in ["--","--","--","--"] track by $index' ng-bind='blank'></td>
								<td class="rank" ng-bind='escuela.stats[statsYear].alumnos || "--"'></td>
								<td class="rank" ng-bind='getPCT(escuela.poco_confiables,escuela) || "--"'></td>
							</tr>
						</tbody>
					</table>				
				</div>
			</div>
			<div role="tabpanel" class="tab-content phone-content" aria-labelledby="tab1" ng-switch-when="3" md-swipe-left="next()" md-swipe-right="previous()" >
				<div id="map">
					<leaflet id="map" center="center" markers="markers"></leaflet>	
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