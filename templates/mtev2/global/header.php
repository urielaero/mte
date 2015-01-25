<div class='menu' ng-controller="headerCTL">
	<div id="button-menu-mobile" ng-click="toggleLeft()">
		<hr><hr><hr>
	</div>
	<div class='container'>
		<div layout="row" class="row-links">
			<a flex="25" flex-sm="100" href='/' class='logo'><img src='/templates/mtev2/img/logo_mejora.png' /></a>
			<a flex="15" class='principal' href='/compara/' hide-sm>
				<i class="icon-conoce-01"></i>
				<strong>1</strong> CONOCE
			</a>
			<a flex="15" class='principal' href='/compara/escuelas/' hide-sm>
				<i class="icon-compara-01"></i>
				<strong>2</strong> COMPARA
			</a>
			<a flex="15" class='principal' href='/califica-tu-escuela/califica/' hide-sm>
				<i class="icon-califica2-01"></i>
				<strong>3</strong> CALIFICA
			</a>
			<a flex="15" class='principal' href='/mejora' hide-sm>
				<i class="icon-mejora"></i>
				<strong>4</strong> MEJORA
			</a>
			<div flex hide-sm class="social-icons">
				<a href="https://www.facebook.com/MejoraTuEscuela"><i class="icon-fb-01"></i></a>
				<a href="https://twitter.com/mejoratuescuela"><i class="icon-twitter-01-01"></i></a>

			</div>
			<div class='clear'></div>
		</div>
	</div>
</div>
<md-sidenav class="md-sidenav-left md-whiteframe-z2"  id="sidebar-menu" md-component-id="left">
	<md-toolbar class="md-theme-light" ng-controller="sidebarCTL">
        <md-button class="md-fab md-primary" ng-click="close()" md-theme="cyan" id="close-button" aria-label="Profile">
            <i class="icon-tache-01"></i>
        </md-button>
		<!--<h1 class="md-toolbar-tools">Menu</h1>-->
	</md-toolbar>
	<md-content class="md-padding">
		<ul>
			<li>
				<md-button class="md-primary">
					<a class="md-raised md-primary" href='/compara/'>
						<i class="icon-conoce-01"></i> 1 CONOCE
					</a>
				</md-button>
			</li>
			<li>
				<md-button class="md-primary">
					<a class="md-raised md-primary" href='/compara/escuelas/'>
						<i class="icon-compara"></i> 2 COMPARA
					</a>
				</md-button>	
			</li>
			<li>
				<md-button class="md-primary">
					<a class="md-raised md-primary" href='/califica-tu-escuela/califica/'>
						<i class="icon-califica2-01"></i> 3 CALIFICA
					</a>
				</md-button>	
			</li>
			<li>
				<md-button class="md-primary">
					<a class="md-raised md-primary" href='/mejora'>
						<i class="icon-mejora"></i> 4 MEJORA
					</a>
				</md-button>	
			</li>
		</ul>
	</md-content>
</md-sidenav>

<md-sidenav  class="md-sidenav-left md-whiteframe-z2"  id="sidebar-compare" md-component-id="comparaSidenav">
	<md-toolbar class="md-theme-light" ng-controller="compareSidebarCTL">
		<a href="#" ng-click="close()" id="close-button-compara"><i class="icon-tache-01"></i></a>
		<h3>Compara escuelas</h3>
	</md-toolbar>
	<md-content >
		<div class="block search-box">
			<p><label for="search_input"><strong>Busca una escuela</strong></label></p>
			<p><input type="text" placeholder="Nombre de la escuela"></p>
		</div>
		<div class="block to-compare">
			<p><label><strong>Escuelas para comparar</strong></label></p>
			<ul>
				<li>
					<a href="#" class="check on"><i class="icon-check-01"></i></a>
					<p><strong>Mi patria es primero</strong></p>
					<p><i class="icon-mapa"></i> Chihuahua, Chihuahua, Calle No. 22</p>
				</li>
				<li>
					<a href="#" class="check on"><i class="icon-check-01"></i></a>
					<p><strong>Mi patria es primero</strong></p>
					<p><i class="icon-mapa"></i> Chihuahua, Chihuahua, Calle No. 22</p>
				</li>
			</ul>
			<a href="#" class="button-bordered">Comparar</a>
		</div>
		<div class="block visited">
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
		</div>
	</md-content>
</md-sidenav>