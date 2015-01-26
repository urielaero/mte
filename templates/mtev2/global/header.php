<div class='menu perfect-menu' ng-controller="headerCTL">
	<div id="button-menu-mobile" ng-click="toggleLeft()">
		<hr><hr><hr>
	</div>
	<div class='container'>
		<div layout="row" class="row-links">
			<a flex="25" flex-sm="100" href='/' class='logo'><img src='/templates/mtev2/img/logo_mejora.png' /></a>
			<a flex="15" class="principal perfect-principal <?php if(strstr($_SERVER['REQUEST_URI'], 'compara/escuelas')){ echo 'none';}elseif(strstr($_SERVER['REQUEST_URI'], 'compara')){ echo 'active';} ?>  " href='/compara/' hide-sm>
				<i class="icon-conoce-01 "></i>
				<strong>1</strong> CONOCE
			</a>
			<a flex="15" class='principal <?php if(strstr($_SERVER['REQUEST_URI'], 'compara/escuelas')){ echo 'active';} ?> ' href='/compara/escuelas/' hide-sm>
				<i class="icon-compara-01 icon-compara-header" style="margin: auto; font-size: 50px; margin-top: -10px;padding-right:10px"></i>
				<strong>2</strong> COMPARA
			</a>
			<a flex="15" class='principal <?php if(strstr($_SERVER['REQUEST_URI'], '/califica-tu-escuela/')){ echo 'active';} ?>' href='/califica-tu-escuela/califica/' hide-sm>
				<i class="icon-califica2-01"></i>
				<strong>3</strong> CALIFICA
			</a>
			<a flex="15" class='principal <?php if(strstr($_SERVER['REQUEST_URI'], '/mejora')){ echo 'active';} ?>' href='/mejora/' hide-sm>
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
						<i class="icon-compara-01"></i> 2 COMPARA
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
<script type="text/ng-template" id="comparaSidebar.html">
	<?php $this->include_template('comparaSidebar','directives'); ?>
</script>
<script type="text/ng-template" id="comparaTextSearch.html">
	<?php $this->include_template('comparaTextSearch','directives'); ?>
</script>
<div compara-sidebar></div>