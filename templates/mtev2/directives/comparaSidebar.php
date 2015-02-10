<md-sidenav  class="md-sidenav-left md-whiteframe-z2"  id="sidebar-compare" md-component-id="comparaSidenav" layout='column'>
	<md-toolbar class="md-theme-light" >
		<a href="" ng-click="close()" id="close-button-compara"><i class="icon-tache-01"></i></a>
		<p class="compara-icon-wrap"><i class="icon-compara-01"></i></p>
		<h3>Compara escuelas</h3>
	</md-toolbar>
	<md-content layout='column' flex >
		<md-content class="block search-box" layout='column'>
			<p><label for="search_input"><strong>Busca una escuela</strong></label></p>
			<p><div mte-text-search object='textSearch' temp="comparaTextSearch" ></div></p>

		</md-content>
		<md-content class="block to-compare" flex layout='column'>
			<p><label><strong>Escuelas para comparar</strong></label></p>
			<md-content style='background:none' flex>
				<ul ng-show='schools.selected.length > 0'>
					<li ng-repeat='escuela in schools.selected'>
						<a href="" ng-click='toggleSchool(escuela)' class="check on"><i class="icon-check-01"></i></a>
						<p><a ng-href='/escuelas/index/{{escuela.cct}}'><strong ng-bind='escuela.nombre'></strong></a></p>
						<p><i class="icon-mapa"></i> {{escuela.localidad}}, {{escuela.entidad}}</p>
					</li>
				</ul>
				<p ng-show='schools.selected.length == 0'>	
					No has selecionado escuelas para comparar aún, <br/> 
					visita la sección de <a href='/compara/'>conoce para buscar y comparar escuelas tu escuela.</a>
					<br/>ó usa la busqueda al principio de este recuadro.
				</p>
			</md-content>
			<a href="/compara/escuelas" target="_self" class="button-bordered">Comparar</a>
		</md-content>
		<md-content class="block visited" flex>
			<p><label><strong>Escuelas visitadas</strong></label></p>
			<p ng-show='schools.visited.length > 0'>Selecciona alguna para comparar</p>
			<md-content style='background:none' flex>
				<ul ng-show='schools.visited.length > 0'>
					<li ng-show='!isSelected(escuela)' ng-repeat='escuela in schools.visited'>
						<a href="" class="check on" ng-click='selectSchool(escuela)' ></i></a>
						<p><a ng-href='/escuelas/index/{{escuela.cct}}'><strong ng-bind='escuela.nombre'></strong></p></p>
						<p><i class="icon-mapa"></i> {{escuela.localidad}}, {{escuela.entidad}}</p>
					</li>
				</ul>
				<p ng-show='schools.visited.length == 0'>	
					No has visitado perfiles de escuelas aún, <br/> 
					visita la sección de <a href='/compara/'>conoce para buscar tu escuela.</a>
				</p>
			</md-content>
		</md-content>
	</md-content>
</md-sidenav>
<div id="toggle-compara">
	<div id="top" ng-click="toggleComparador()">
		<div class="top">
			<p><a href=""><i class="icon-compara-01 top-icono"></i></a></p>
			<p class="texto-top"><a href="">Comparar</a></p>
		</div>
		<div class="num" ng-bind='schools.selected.length'></div>		
	</div>
</div>