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
						<div flex><div layout="row" layout-margin>
							<div flex>Número de alumnos:</div>
							<div flex class="number">73</div>
						</div></div>
						<div flex><div layout="row" layout-margin>
							<div flex>Número de alumnos:</div>
							<div flex class="number">73</div>
						</div></div>
						<div flex><div layout="row" layout-margin>
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
			<div class="additional-info space-between" layout="row" layout-sm="column">
				<div class="data" flex="73" flex-sm="100">
					<form action="/" method="GET" class="comment-form">
						<div layout="row">
							<div flex="10" class="icon-container" hide-sm>
								<i class="icon-comentario-01"></i>
							</div>						
							<textarea flex="90" flex-sm="100" placeholder="Deja un comentario de esta escuela aquí"></textarea>
						</div>
						<div class="fields" layout="row" layout-margin layout-fill layout-padding>
							<input type="text" name="nombre" flex placeholder="Nombre">
							<input type="email" name="correo" flex placeholder="Correo electrónico">
							<select flex>
								<option value="">¿Quien eres?</option>
							</select>
						</div>
						<div class="sumbit-fields space-between" layout="row" layout-sm="column">
							<div class="captcha" flex="33" flex-sm="100"></div>
							<div flex="66" flex-sm="100">
								<div layout="row" class="space-between">
									<md-button type="submit" class="md-raised" flex="49">Enviar</md-button>
									<div flex="49" class="check">
										<md-checkbox name="check" value="1" aria-label="Checkbox 1">*Quiero que mi nombre se publique junto con mi comentario</md-checkbox>
									</div>
								</div>
								<div class="msg">
									<p>*Tu correo electronico NO aparecerá con tu comentario.</p>
									<p>Si no quieres que tu comentario se publique en el perfil de la escuela, escribenos a:contacto@mejoratuesceual.org</p>
								</div>
							</div>
						</div>
					</form>
				    <md-tabs class="tabs-data" md-selected="selectedData">
				    	<md-tab class="desempeno-tab" aria-controls="tab1-content">
				        	Desempeño<br/>academico
				      	</md-tab>
				      	<md-tab class="infraestructura-tab" aria-controls="tab2-content">
				        	Infraestructura<br/>escolar
				      	</md-tab>
				      	<md-tab class="comentarios-tab" aria-controls="tab2-content">
				        	Comentarios y<br/>reportes
				      	</md-tab>
				    </md-tabs>

				    <ng-switch on="selectedData" class="tabpanel-container">
				        <div role="tabpanel" class="desempeno" id="profile-content" aria-labelledby="tab1" ng-switch-when="0">
							<h2>Desempeño Académico Matutino</h2>
							<div class="block" layout="row" layout-sm="column" layout-margin layout-fill layout-padding>
								<div flex>
									<div layout="row">
										<div flex="70"><p>Número de alumnos evaluados</p></div>
										<div flex="30" class="number"><p>73</p></div>
									</div>
								</div>
								<div flex>
									<div layout="row">
										<div flex="70"><p>Porcentaje de alumnos en nivel reprobatorio</p></div>
										<div flex="30" class="number"><p>0.00%</p></div>
									</div>
								</div>								
							</div>
							<div class="chart-block mate" layout="row">
								<div class="purple" flex="25">
									<p class="i-cont"><i class="icon-calculadora-01"></i></p>
									<p>Resultados</p>
									<p>ENLACE</p>
									<div class="label"><p>Matemáticas</p></div>
								</div>
								<div flex="75" class="chart"></div>
							</div>
							<div class="chart-block espanol" layout="row">
								<div class="purple" flex="25">
									<p class="i-cont"><i class="icon-enlace-01"></i></p>
									<p>Resultados</p>
									<p>ENLACE</p>
									<div class="label"><p>Español</p></div>
								</div>
								<div flex="75" class="chart"></div>
							</div>
						</div>
				        <div role="tabpanel" class="infraestructura tables-box" id="profile-content" aria-labelledby="tab1" ng-switch-when="1">
							<h2>Infraestructura escolar</h2>
							<div class="table-top" layout="row">
								<div flex="10" class="i-cont"><i class="icon-instalaciones-01"></i></div>
								<div flex="90"><p>Instalaciones</p></div>
							</div>
							<table>
								<tr><td>Aulas para clase</td><td>12</td></tr>
								<tr><td>Áreas deportivas o recreativas</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Patio o plaza cívica</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Sala de computo</td><td>0</td></tr>
								<tr><td>Cuartos para baño o sanitarios</td><td>8</td></tr>
								<tr><td>Tazas sanitarios</td><td>17</td></tr>
							</table>
							<div class="table-top" layout="row">
								<div flex="10" class="i-cont"><i class="icon-servicios-01"></i></div>
								<div flex="90"><p>Servicios</p></div>
							</div>
							<table>
								<tr><td>Energia eléctrica</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Servicio de agua de la red pública</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Drenaje</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Cisterna o alijibe</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Servicio de internet</td><td><i class="icon-tache-01"></i></td></tr>
								<tr><td>Télefono</td><td><i class="icon-check-01"></i></td></tr>
							</table>
							<div class="table-top" layout="row">
								<div flex="10" class="i-cont"><i class="icon-seguridad-01"></i></div>
								<div flex="90"><p>Seguridad</p></div>
							</div>
							<table>
								<tr><td>Señales de protección civil</td><td><i class="icon-tache-01"></i></td></tr>
								<tr><td>Rutas de evacuación</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Salidas de emergencia</td><td><i class="icon-check-01"></i></td></tr>
								<tr><td>Zonas de seguridad</td><td><i class="icon-tache-01"></i></td></tr>
							</table>
						</div>
				        <div role="tabpanel" class="comentarios tables-box" id="profile-content" aria-labelledby="tab1" ng-switch-when="2">
							<h2>Comentarios</h2>
							<div class="table-top" layout="row">
								<div flex="10" class="i-cont"><i class="icon-estrella-01"></i></div>
								<div flex="90"><p>Calificación global de la escuela según usuarios</p></div>
							</div>
							<table>
								<tr><td>Calificación global</td><td>10.0</td></tr>
							</table>
							<div class="table-top" layout="row">
								<div flex="10" class="i-cont"><i class="icon-pregunta-01"></i></div>
								<div flex="90"><p>Calificación promedio por pregunta</p></div>
							</div>
							<table>
								<tr><td>Preparación de maestros</td><td>10.0</td></tr>
								<tr><td>Asistencia de los maestros</td><td>10.0</td></tr>
								<tr><td>Relación con los padres de familia</td><td>10.0</td></tr>
							</table>
							<div class="table-top" layout="row">
								<div flex="10" class="i-cont"><i class="icon-comentario2-01"></i></div>
								<div flex="90"><p>Calificación promedio por pregunta</p></div>
							</div>
							<ul class="comments-list">
								<li>
									<p><strong class="green">Calificación: 10 | </strong>Felipe (Padre de familia)</p>
									<p>14 Ago 2014</p>
									<p>La verdad es que esta escuela me parece de las mejores, muy recomendado</p>
								</li>
								<li>
									<p><strong class="green">Calificación: 10 | </strong>Felipe (Padre de familia)</p>
									<p>14 Ago 2014</p>
									<p>La verdad es que esta escuela me parece de las mejores, muy recomendado</p>
								</li>
								<li>
									<p><strong class="green">Calificación: 10 | </strong>Felipe (Padre de familia)</p>
									<p>14 Ago 2014</p>
									<p>La verdad es que esta escuela me parece de las mejores, muy recomendado</p>
								</li>
							</ul>
						</div>
					</ng-switch>

				</div>
				<div flex="25" flex-sm="100" class="sidebar">
					<div class="box-yesno ">
						<p><i class="icon-familia-01"></i></p>
						<p>¿Cuenta con Asociación de padres de familia?</p>
						<div class="yes on"><span class="circle"></span>Sí</div>
						<div class="no"><span class="circle"></span>No</div>
					</div>
					<div class="box-yesno orange">
						<p><i class="icon-desk-01"></i></p>
						<p>¿Cuenta con Consejo de participacion social?</p>
						<div class="yes on"><span class="circle"></span>Sí</div>
						<div class="no"><span class="circle"></span>No</div>
					</div>
					<div class="box-yesno green">
						<p>¿Esta escuela fue censada?</p>
						<div class="yes on"><span class="circle"></span>Sí</div>
						<div class="no"><span class="circle"></span>No</div>
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