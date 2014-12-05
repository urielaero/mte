<div class="container profile profile-escuela" ng-controller="escuelaCTL">
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Escuela</a>
		<a href="#">Quintana Roo</a>
		<a href="#">Benito Juarez</a>
		<a href="#">Colegio Ecab</a>
	</div>
	<div class="menu">
		<div layout="row" layout-sm="column" class="menu-row">
			<div class="profile-title" flex="55" flex-sm="100">
				<div class="title-container" layout="row">
					<div flex="25" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-escuela-01"></i>
						</div>
					</div>
					<div flex="75" flex-sm="100">
						<h1>Octavio Paz Locazon</h1>
						<p>Posición estatal 3 de 95</p>
					</div>
				</div>			
			</div>
			<div class="tabs" flex="30" flex-sm="100">
			    <md-tabs md-selected="selectedIndex">
			    	<md-tab id="matutino-tab" aria-controls="tab1-content">
			    		<i class="icon-matutino"></i>
			        	Matutino
			      	</md-tab>
			      	<md-tab id="vespertino-tab" aria-controls="tab2-content">
			      		<i class="icon-vespertino-01"></i>
			        	Vespertino
			      	</md-tab>
			    </md-tabs>				
			</div>
			<div flex="15" flex-sm="100" class="compare-link">
				<a href="#" class="full-size-link"></a>
				<div class="icon-wrapper vertical-align-center horizontal-align-center">
					<div flex="column">
						<div><i class="icon-compara"></i></div>
						<div><a href="">Comparar</a></div>
					</div>
				</div>

			</div>
		</div>
	</div>

    <ng-switch on="selectedIndex" class="tabpanel-container">
        <div role="tabpanel" id="profile-content" aria-labelledby="tab1" ng-switch-when="0" md-swipe-left="next()" md-swipe-right="previous()" >
			<div class="space-between" layout="row" layout-sm="column">
				<div class="main-info" flex="73" flex-sm="100">
					<div layout="row" layout-sm="column">
						<div id="map" flex="50"></div>
						<div class="info" flex="50" flex-sm="100">
							<div class="califica" layout="row">
								<div flex="35" class="icon-container">
 									<div class="icon-wrapper vertical-align-center horizontal-align-center">
										<i class="icon-califica2-01"></i>
									</div>
								</div>
								<div flex="65">
									<h4>CALIFICA TU ESCUELA</h4>
								</div>
								<a href="#" class="full-size-link"></a>
							</div>
							<div class="block">
								<ul>
									<li>Clave: 3234DFRFMRFM</li>
									<li>Bachillerato</li>
									<li>Turno: Matutino</li>
									<li>Pública</li>
									<li>Télefonos: 0129393</li>
									<li>Correo electrónico: escuela@example.com</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="address" layout="row" layout-sm="column">
						<div flex>
							<ul>
								<li>Calle: Josefa Ortiz de Dominguez Num. 64</li>
								<li>Municipio: Villa de Alvarez</li>
							</ul>
						</div>
						<div flex>
							<ul>
								<li>Localidad: Ciudad de Villa de Alvarez</li>
								<li>Entidad: Colima</li>
							</ul>
						</div>
					</div>
					<div class="counters" layout="row" layout-sm="column">
						<div flex><div layout="row">
							<div flex>Número de alumnos:</div>
							<div flex class="number">73</div>
						</div></div>
						<div flex><div layout="row">
							<div flex>Número de alumnos:</div>
							<div flex class="number">73</div>
						</div></div>
						<div flex><div layout="row">
							<div flex>Número de alumnos:</div>
							<div flex class="number">73</div>
						</div></div>
					</div>
				</div>
				<div class="semaphore" flex="25" flex-sm="100">
					<h4>Semáforo educativo</h4>
					<ul>
						<li class="rank1 on">
							<div layout="row">
								<div flex="70" class="label">Excelente</div>
								<div flex="30" class="circle">
							        <md-button class="md-fab" aria-label="Time"><i class="icon-check-01"></i></md-button>									
								</div>
							</div>
						</li>
						<li class="rank2">
							<div layout="row">
								<div flex="70" class="label">Bien</div>
								<div flex="30" class="circle">
							        <md-button class="md-fab" aria-label="Time"><i class="icon-check-01"></i></md-button>									
								</div>
							</div>
						</li>
						<li class="rank3">
							<div layout="row">
								<div flex="70" class="label">De panzazo</div>
								<div flex="30" class="circle">
							        <md-button class="md-fab" aria-label="Time"><i class="icon-tache-01"></i></md-button>									
								</div>
							</div>
						</li>
						<li class="rank4">
							<div layout="row">
								<div flex="70" class="label">Reprobado</div>
								<div flex="30" class="circle">
							        <md-button class="md-fab" aria-label="Time"><i class="icon-tache-01"></i></md-button>									
								</div>
							</div>
						</li>
					</ul>
					<div class="options space-between" layout="row" layout-md="column">
						<div flex="49" class="option">
								<p><i class="icon-print-01"></i></p>
								<p>Imprimir</p>
						</div>
						<div flex="49" class="option">
								<p><i class="icon-share-01"></i></p>
								<p>Compartir</p>
						</div>
					</div>
				</div>
			</div>	
        </div>
        <div role="tabpanel" id="tab3-content" aria-labelledby="tab2" ng-switch-when="1" md-swipe-left="next()" md-swipe-right="previous()">
            View for Item #3<br/>
            data.selectedIndex = 2
        </div>
    </ng-switch>
</div>