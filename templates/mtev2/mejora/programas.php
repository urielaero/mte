<script type='text/javascript'>
    window.programas = <?= json_encode($this->programas_json)?>;
    window.entidades = <?= json_encode($this->entidades)?>;
</script>
<div class="cont-semaforos-results" ng-controller='programasCTL'>
	<div class='container results programas mteNgSearch' >
		<div class="breadcrumb">
			<a  href="http://www.mejoratuescuela.org/mejora" class="start"><i class="icon-mejora"></i></a>
			<a  href="http://www.mejoratuescuela.org/mejora">Conoce</a>
		</div>
		<div layout="row" class="post-title">
			<div flex="10" class="icon-container" hide-sm>
				<div class="icon-wrapper vertical-align-center horizontal-align-center">
					<i class="icon-programas"></i>
				</div>
			</div>
			<h1 flex="90"><strong>Programas de apoyo</strong></h1>
		</div>
		<div layout="row" layout-sm="column" class="space-between">
			<div flex="25" flex-sm="100" id="filters">
				<form>
					<label>Programa</label>
					<div layout="row" class="text-field">
						<input type="text" ng-model='params.text' flex="80" placeholder="Ej. Programa escuela segura">
						<input type="submit" value="" flex="20">
					</div>
					<label>Tema de enfoque</label>
					<select ng-model='params.tema' ng-options='tema as tema for tema in temas' ></select>
					<label>Zonas de impacto</label>
					<select ng-model='params.zona' ng-options='zona as zona.nombre.capitalize() for zona in zonas' ></select>
					<label>Nivel escolar</label>
					<p ng-repeat='nivel in niveles' ><md-checkbox ng-model='params.niveles[nivel.id]' aria-label="nivel.label">{{nivel.label}}</md-checkbox></p>
					<label>Programas</label>
					<p ng-repeat='control in controles' ><md-checkbox ng-model='params.controles[control.id]'aria-label="control.label">{{control.label}}</md-checkbox></p>
				</form>
			</div>
			<div ng-if="!currentPrograms.length" flex flex-sm="100" id="message-not-found">
				<h2><strong>No se encontraron resultados</strong></h2>
				<p>Te sugerimos realizar una búsqueda más avanzada</p>
				<p><img src="/templates/mtev2/img/buscando.png" alt=""></p>
			</div>
			<div ng-hide='!currentPrograms.length' flex="70" flex-sm="100" id="results">
				<!-- <div layout="row" layout-sm="column">
					<h2 flex="40" flex-sm="100">34,598 Resultados</h2>
					<div class="order-by" flex="60" flex-sm="100">
						<select><option>Orden alfabético</option></select>
						<label>Ordenar por:</label>
						<div class="clear"></div>
					</div>
				</div> -->
				<div class="compare-table">
					<table class="footable">
						<thead>
							<tr>
								<th class="footable-first-column">Programa</th>
								<th data-hide="phone">Zona de cobertura</th>
								<th class="footable-last-column">Federal | Organización civil</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='programa in currentPrograms = (programas | programasFilter:params)'>
								<td id="contenedor-programas">
									<div id="imagen-programa"><img class="imagen-programa" ng-src='http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com//programas_{{programa.id}}.jpg' /></div>
									<a ng-href='/programas/index/{{programa.id}}'><strong ng-bind='programa.nombre' ></strong></a>
									<p><small><i class="icon-conoce-01"></i> <span ng-bind='programa.tema_especifico'></span></small></p>
									<!--<img ng-src='/templates/mtev2/img/programas/{{programa.id}}.jpg' />
									<a ng-href='/programas/index/{{programa.id}}'><strong ng-bind='programa.nombre' ></strong></a>
									<p><small><i class="icon-conoce-01"></i> <span ng-bind='programa.tema_especifico'></span></small></p>-->
								</td>
								<td ng-bind='programa.zonas'></td>
								<td ng-bind='controles[programa.federal].label'></td>
							</tr>

						</tbody>
					</table>
				</div>
				<!-- <div class="pagination">
					<a href="#">1</a>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">&gt;</a>
					<a href="#">Últimas &gt;</a>
				</div>	 -->
			</div>
		</div>
	</div>	
</div>
