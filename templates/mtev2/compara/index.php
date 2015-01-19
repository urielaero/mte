<div class='container compare' ng-controller="compareCTL">
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Escuela</a>
		<a href="#">Quintana Roo</a>
	</div>	
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
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td>
								<md-button class="md-fab rank1" aria-label="Time"><i class="icon-tache-01"></i></md-button>
								<p>Excelente</p>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td>
								<md-button class="md-fab rank2" aria-label="Time"><i class="icon-check-01"></i></md-button>
								<p>Bien</p>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td>
								<md-button class="md-fab rank3" aria-label="Time"><i class="icon-check-01"></i></md-button>
								<p>De panzazo</p>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td>
								<md-button class="md-fab rank4" aria-label="Time"><i class="icon-tache-01"></i></md-button>
								<p>Reprobado</p>
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
							<th data-hide="phone">2006</th>
							<th data-hide="phone">2007</th>
							<th data-hide="phone">2008</th>
							<th data-hide="phone">2009</th>
							<th data-hide="phone">2010</th>
							<th data-hide="phone">2011</th>
							<th data-hide="phone">2012</th>
							<th data-hide="phone">2013</th>
							<th class="footable-last-column">2014</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>385</td>
							<td>385</td>
							<td>542</td>
							<td>542</td>
							<td>--</td>
							<td>542</td>
							<td>322</td>
							<td>525</td>
							<td>418</td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>385</td>
							<td>385</td>
							<td>542</td>
							<td>542</td>
							<td>--</td>
							<td>542</td>
							<td>322</td>
							<td>--</td>
							<td>418</td>
						</tr>
						<tr>
							<td>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>385</td>
							<td>--</td>
							<td>542</td>
							<td>542</td>
							<td>--</td>
							<td>542</td>
							<td>322</td>
							<td>--</td>
							<td>418</td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla mujeres, Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>385</td>
							<td>385</td>
							<td>542</td>
							<td>542</td>
							<td>--</td>
							<td>542</td>
							<td>322</td>
							<td>--</td>
							<td>418</td>

						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</ng-switch>
	<div class="search-form">
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
	</div>
	<a href="#" class="add-school">Agregar otra escuela</a>	
</div>