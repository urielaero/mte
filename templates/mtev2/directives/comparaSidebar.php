<md-sidenav  class="md-sidenav-left md-whiteframe-z2"  id="sidebar-compare" md-component-id="comparaSidenav" layout='column'>
	<md-toolbar class="md-theme-light" >
		<a href="#" ng-click="close()" id="close-button-compara"><i class="icon-tache-01"></i></a>
		<h3>Compara escuelas</h3>
	</md-toolbar>
	<md-content layout='column' flex >
		<md-content class="block search-box" layout='column'>
			<p><label for="search_input"><strong>Busca una escuela</strong></label></p>
			<p><input type="text" placeholder="Nombre de la escuela"></p>
		</md-content>
		<md-content class="block to-compare" flex>
			<p><label><strong>Escuelas para comparar</strong></label></p>
			<ul>
				<li ng-repeat='escuela in schools.selected'>
					<a href="#" class="check on"><i class="icon-check-01"></i></a>
					<p><strong ng-bind='escuela.nombre'></strong></p>
					<p><i class="icon-mapa"></i> {{escuela.localidad}}, {{escuela.entidad}}</p>
				</li>
			</ul>
			<a href="/compara/escuelas" class="button-bordered">Comparar</a>
		</md-content>
		<md-content class="block visited" flex>
			<p><label><strong>Escuelas visitadas</strong></label></p>
			<p>Selecciona alguna para comparar</p>
			<ul>
				<li>
					<a href="#" class="check"><i class="icon-check-01"></i></a>
					<p><strong>Mi patria es primero</strong></p>
					<p><i class="icon-mapa"></i> Chihuahua, Chihuahua, Calle No. 22</p>
				</li>
				<li>
					<a href="#" class="check"><i class="icon-check-01"></i></a>
					<p><strong>Mi patria es primero</strong></p>
					<p><i class="icon-mapa"></i> Chihuahua, Chihuahua, Calle No. 22</p>
				</li>
			</ul>
			<a href="#" class="button-bordered">Comparar</a>
		</md-content>
	</md-content>
</md-sidenav>