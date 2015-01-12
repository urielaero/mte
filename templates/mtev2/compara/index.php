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
		    		<i class="icon-matutino"></i>
		    		<p>General</p>
		      	</md-tab>
		      	<md-tab class="results-tab" aria-controls="tab2-content">
		      		<i class="icon-vespertino-01"></i>
		      		<p>Resultados por año</p>
		      	</md-tab>
		    	<md-tab class="student-tab" aria-controls="tab1-content">
		    		<i class="icon-matutino"></i>
		    		<p>Desempeño por alumno</p>
		      	</md-tab>
		      	<md-tab class="map-tab" aria-controls="tab2-content">
		      		<i class="icon-vespertino-01"></i>
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
							<th data-hide="phone">Calificación Español</th>
							<th data-hide="phone">Calificiación Matemáticas</th>
							<th data-hide="phone">Nivel Escolar</th>
							<th data-hide="phone">Turno</th>
							<th data-hide="phone">Privada publica</th>
							<th>Posicion Estatal</th>
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
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td><md-button class="md-fab rank1" aria-label="Time"><i class="icon-check-01"></i></md-button></td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td><md-button class="md-fab rank2" aria-label="Time"><i class="icon-check-01"></i></md-button></td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td><md-button class="md-fab rank3" aria-label="Time"><i class="icon-check-01"></i></md-button></td>
						</tr>
						<tr>
							<td>
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
							</td>
							<td>777</td>
							<td>739</td>
							<td>Primaria</td>
							<td>Matutino</td>
							<td>Privada</td>
							<td><strong>1</strong> de <strong>548</strong></td>
							<td><md-button class="md-fab rank4" aria-label="Time"><i class="icon-check-01"></i></md-button></td>
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
								<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
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
								<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
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
								<strong>Jean Piaget</strong>
								<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
								<p><small><i class="icon-enlace-01"></i> Matutino</small></p>
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
								<p><small><i class="icon-conoce-01"></i> Isla Mujeres Quintana Roo</small></p>
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
	<a href="#" class="add-school">Agregar otra escuela</a>	
</div>