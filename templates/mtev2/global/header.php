<div class='menu' ng-controller="headerCTL">
	<div id="button-menu-mobile" ng-click="toggleLeft()"></div>
	<div class='container'>
		<div layout="row" class="row-links">
			<a flex="25" href='/' class='logo'><img src='/templates/mtev2/img/logo_mejora.png' /></a>
			<a flex="15" class='principal' href='/compara/' hide-sm>
				<i class="icon-conoce-01"></i>
				<strong>1</strong> CONOCE
			</a>
			<a flex="15" class='principal' href='/compara/escuelas/' hide-sm>
				<i class="icon-compara"></i>
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
				<a href="https://www.facebook.com/MejoraTuEscuela"><i class="icon-fb"></i></a>
				<a href="https://twitter.com/mejoratuescuela"><i class="icon-twitter-01"></i></a>

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
					<a href='/compara/'>
						<i class="icon-conoce-01"></i> 1 CONOCE
					</a>
				</li>
				<li>
					<a href='/compara/escuelas/'>
						<i class="icon-compara"></i> 2 COMPARA
					</a>	
				</li>
				<li>
					<a href='/califica-tu-escuela/califica/'>
						<i class="icon-califica2-01"></i> 3 CALIFICA
					</a>	
				</li>
				<li>
					<a href='/mejora'>
						<i class="icon-mejora"></i> 4 MEJORA
					</a>	
				</li>
			</ul>
		</md-content>
	</md-sidenav>
