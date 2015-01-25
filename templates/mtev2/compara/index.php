<div class='container compare' ng-controller="comparaCTL">
	<div class="breadcrumb">
		<a href="/" class="start"><i class="icon-mejora"></i></a>
		<a href="/compara">Compara</a>
	</div>
	<div layout='row' ng-show='loading' class='loader' layout-align='center center'>
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
								<th data-hide="phone">Calificiación matemáticas</th>
								<th data-hide="phone">Nivel escolar</th>
								<th data-hide="phone">Turno</th>
								<th data-hide="phone">Privada pública</th>
								<th>Posicion estatal</th>
								<th class="footable-last-column">Semáforo educativo</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='escuela in escuelas'>
								<td>
									<a ng-href='/escuelas/index/{{escuela.cct}}'><strong ng-bind='escuela.nombre'></strong></a>
									<p><small><i class="icon-conoce-01"></i> {{escuela.localidad}}, {{escuela.entidad}}</small></p>
									<p><small><i class="icon-enlace-01" ng-show='escuela.turno.nombre' ></i> {{escuela.turno.nombre}}</small></p>
								</td>
								<td ng-bind='escuela.promedio_espaniol || "--"'></td>
								<td ng-bind='escuela.promedio_matematicas || "--"'></td>
								<td>{{escuela.nivel}}</td>
								<td>{{escuela.turno.nombre.capitalize()}}</td>
								<td>{{escuela.control}}</td>
								<td><strong ng-bind='escuela.rank || "--"'></strong> de <strong ng-bind='escuela.entidad_cct_count'></strong></td>
								<td>
									<md-button ng-class="semaforos[escuela.semaforo].class" class="md-fab" aria-label="Time">
										<i class="semaforos-buscador" ng-class="semaforos[escuela.semaforo].icon"></i>
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
									<p><small><i class="icon-enlace-01"></i> {{escuela.turno.nombre}}</small></p>
								</td>
								<td ng-repeat='year in years' ng-bind='escuela.avgs[year] || "--"'></td>
							</tr>
						</tbody>
					</table>
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
		<a href="#" class="add-school">Agregar otra escuela</a>	
	</div>
</div>