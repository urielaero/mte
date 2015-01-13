<div class='container results' ng-controller="compareCTL">
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Conoce</a>
	</div>
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="25" flex-sm="100" id="filters">
			<form>
				<label>Escuela o bibilioteca</label>
				<div layout="row" class="text-field">
					<input type="text" flex="80" placeholder="Ej. Jean Piaget">
					<input type="submit" value="" flex="20">
				</div>
				<label>Estado</label>
				<select>
					<option value="">Todos</option>
				</select>
				<label>Municipio</label>
				<select>
					<option value="">Todos</option>
				</select>
				<label>Localidad</label>
				<select>
					<option value="">Todos</option>
				</select>
				<label>Nivel Escolar</label>
				<p><md-checkbox aria-label="Checkbox 1">Prescolar</md-checkbox></p>
				<p><md-checkbox aria-label="Checkbox 1">Primaria</md-checkbox></p>
				<p><md-checkbox aria-label="Checkbox 1">Secundaria</md-checkbox></p>
				<p><md-checkbox aria-label="Checkbox 1">Bachillerato</md-checkbox></p>
				<label>Turno</label>
				<p><md-checkbox aria-label="Checkbox 1">Matutino</md-checkbox></p>
				<p><md-checkbox aria-label="Checkbox 1">Vespertino</md-checkbox></p>
				<label>Sector</label>
				<p><md-checkbox aria-label="Checkbox 1">Privado</md-checkbox></p>
				<p><md-checkbox aria-label="Checkbox 1">Público</md-checkbox></p>
			</form>
		</div>
		<div flex="70" flex-sm="100" id="results">
			<div layout="row" layout-sm="column">
				<h2 flex="40" flex-sm="100">34,598 Resultados</h2>
				<div class="order-by" flex="60" flex-sm="100">
					<select><option>ORDEN ALFABÉTICO</option></select>
					<label>ORDENAR POR:</label>
					<div class="clear"></div>
				</div>
			</div>
			<div class="compare-table">
				<table class="footable">
					<thead>
						<tr>
							<th class="footable-first-column">Escuelas</th>
							<th data-hide="phone">Nivel Escolar</th>
							<th data-hide="phone">Turno</th>
							<th data-hide="phone">Privada / Pública</th>
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
							<td>Bachillerato</td>
							<td>Vespertino</td>
							<td>Pública</td>
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
							<td>Vespertino</td>
							<td>Pública</td>
							<td>
								<md-button class="md-fab rank4" aria-label="Time"><i class="icon-tache-01"></i></md-button>
								<p>Reprobado</p>
							</td>
						</tr>

					</tbody>
				</table>
			</div>
			<a href="#" class="compare-button">COMPARAR</a>
			<div class="pagination">
				<a href="#">1</a>
				<a href="#">2</a>
				<a href="#">3</a>
				<a href="#">&gt;</a>
				<a href="#">ULTIMAS &gt;</a>
			</div>	
		</div>
	</div>
</div>