<div class='container results mteNgSearch'>
	<div layout="row" layout-sm="column" class="space-between">
		<div ng-show='showSearch' flex="25" flex-sm="100" id="filters" >
			<form>
				<div mte-text-search term='termSearch(term)' temp="mteTextSearch" urls='1'></div>

				<div hide-gt-sm id="ubicacion-btn" class="boton-filtrar" flex ng-click="estadoVisibility = !estadoVisibility">
					<div id="titulo-filtrar">
						<h5 class="titulo-filtrar">Ubicación</h5>
					</div>
					<div id="icono-filtrar">
						<img class="icono-filtrar" src="/templates/mtev2/img/MAS.png">
					</div>
				</div>

				<div id="cont-ubicacion" hide-sm ng-hide="estadoVisibility">
					<label>Estado</label>
					<select ng-model='entidad' ng-disabled='loading' ng-change='entidadChange()' ng-options='entidad as entidad.nombre.capitalize() for entidad in entidades' ></select>
					<label>Municipio</label>
					<select ng-model='municipio' ng-disabled='loading' ng-change='municipioChange()' ng-options='municipio as municipio.nombre for municipio in municipios | municipiosFilter:entidad' ></select>
					<label>Localidad</label>
					<select ng-model='localidad' ng-change='$scope.pagination.current_page = 1;getEscuelas();' ng-disabled='!localidades[1]	' ng-options='localidad as localidad.nombre.capitalize() for localidad in localidades' ></select>
				</div>

				<div hide-gt-sm id="ubicacion-btn" class="boton-filtrar" flex ng-click="nivelVisibility = !nivelVisibility">
					<div id="titulo-filtrar">
						<h5 class="titulo-filtrar">Nivel Escolar</h5>
					</div>
					<div id="icono-filtrar">
						<img class="icono-filtrar" src="/templates/mtev2/img/MAS.png">
					</div>
				</div>

			<div id="cont-ubicacion" hide-sm ng-hide="nivelVisibility">
				<label class="label-nivel">Nivel escolar o tipo de establecimiento</label>
				<p><md-checkbox ng-change='checkBoxChange()' ng-disabled='loading' ng-repeat='nivel in niveles' ng-model='nivel.checked' aria-label="Checkbox 1" >{{nivel.label}}</md-checkbox></p>
			</div>

			<div hide-gt-sm id="ubicacion-btn" class="boton-filtrar" flex ng-click="turnoVisibility = !turnoVisibility">
					<div id="titulo-filtrar">
						<h5 class="titulo-filtrar">Turno</h5>
					</div>
					<div id="icono-filtrar">
						<img class="icono-filtrar" src="/templates/mtev2/img/MAS.png">
					</div>
			</div>

			<div id="cont-ubicacion" hide-sm ng-hide="turnoVisibility">
				<label class="label-nivel">Turno</label>
				<p><md-checkbox ng-change='checkBoxChange()' ng-disabled='loading' ng-repeat='turno in turnos' ng-model='turno.checked' aria-label="Checkbox 1" >{{turno.label}}</md-checkbox></p>
			</div>

			<div hide-gt-sm id="ubicacion-btn" class="boton-filtrar" flex ng-click="sectorVisibility = !sectorVisibility">
					<div id="titulo-filtrar">
						<h5 class="titulo-filtrar">Sector</h5>
					</div>
					<div id="icono-filtrar">
						<img class="icono-filtrar" src="/templates/mtev2/img/MAS.png">
					</div>
			</div>

			<div id="cont-ubicacion" hide-sm ng-hide="sectorVisibility">
				<label class="label-nivel">Sector</label>
				<p><md-checkbox ng-change='checkBoxChange()' ng-disabled='loading' ng-repeat='control in controles' ng-model='control.checked' aria-label="Checkbox 1" >{{control.label}}</md-checkbox></p>
			</div>

			</form>
		</div>
		<div ng-if="!escuelasResponse" flex flex-sm="100" id="message-not-found">
			<h2><strong>No se encontraron resultados</strong></h2>
			<p>Te sugerimos realizar una búsqueda más avanzada</p>
			<p><img src="/templates/mtev2/img/buscando.png" alt=""></p>
		</div>
		<div layout='row' ng-show='loading && escuelasResponse' flex flex-sm="100" layout-align='center center'>
			<md-progress-circular md-mode="indeterminate"></md-progress-circular>
		</div>
		<div ng-hide='loading || !escuelasResponse' flex flex-sm="100" id="results">
			<div ng-show='showSearch' layout="row" layout-sm="column">
				<h2 flex="40" flex-sm="100">{{numberFormat(pagination.count)}} Resultado<span ng-show='pagination.count > 1'>s</span></h2>
				<div class="order-by" flex="60" flex-sm="100">
					<select ng-change='getEscuelas()' ng-options='option for option in sortOptions' ng-model='sort'></select>

					<label>Ordenar por:</label>
					<div class="clear"></div>
				</div>
			</div>
			<div class="compare-table">
				<table class="footable">
					<thead>
						<tr>
							<th class="footable-first-column" ng-bind='tableTitle'></th>
							<th data-hide="phone">Nivel escolar o tipo de establecimiento</th>
							<th data-hide="phone">Turno</th>
							<th >Privada / Pública</th>
							<th style="max-width: 130px" class="footable-last-column">Semáforo educativo</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat='escuela in escuelas'>
								<td class='link' >
									<a layout='row' flex
                                    ng-href='/escuelas/index/{{escuela.cct}}' ng-click="clickSchool($event,escuela)" class="cont-datos-escuela">
										<span class="cont-ico-compara" layout='row' layout-align='center center'>
											<span class="h3-iconmejora">
												<span class="circulo-icon-mejora" ng-click='toggleSchool(escuela,$event)'  >
												   <i ng-class='isChecked(escuela)' class="mejora-icon"></i>
												</span>
											</span>
										</span>
										<span flex class="datos-escuela">
											<strong  ng-bind='escuela.nombre'></strong>
											<p><small><i class="icon-conoce-01"></i> {{escuela.localidad}}, {{escuela.entidad}}</small></p>
											<!--<p ng-show='escuela.turno.nombre'><small><i class="icon-enlace-01"></i> {{escuela.turno.nombre}}</small></p>-->
											<br ng-hide='escuela.turno.nombre' />
										</span>
									</a>

								</td>
							<td>{{escuela.nivel}}</td>
							<td ng-show='escuela.turno.nombre'>{{escuela.turno.nombre.capitalize()}}</td>
							<td ng-show='!escuela.turno.nombre'>No Aplica</td>
							<td>{{escuela.control}}</td>
							<td  style="max-width:172px">
							<!-- los iconos ya se alinean bien de esta forma si se cambia por md-button se desalinean Carlos Barahona-->
								<div id="boton-semaforo-compara" ng-class="semaforos[escuela.semaforo].class" >
								  <div id="semaforos-buscador">
									<i id="semaforos-buscador-icono" ng-class="semaforos[escuela.semaforo].icon"></i>
								  </div>
								</div>
							<!--Carlos Barahona-->
								<p>{{semaforos[escuela.semaforo].label}}</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<a href="/compara/escuelas/" class="compare-button" ng-show='hasSelected()'>Comparar</a>
			<div ng-show='showSearch' class="pagination">			

				<a href="" 
				   ng-show='pagination.current_page - 3 > 1' 
				   ng-click='pagination.current_page = 1; getEscuelas()' >
					   &lt; Primeras 
				</a>
				<a  href="" 
					ng-show='pagination.current_page > 3' 
					ng-click='pagination.current_page = pagination.current_page - 3; getEscuelas()' >
						&lt;
				</a>				
				<a  href="" 
					ng-bind='pagination.current_page - 2 ' 
					ng-show='pagination.current_page > 1 && pagination.current_page + 1 >= pagination.document_pages'
					ng-click='pagination.current_page = pagination.current_page - 2; getEscuelas()' >
				</a>
				<a  href="" 
					ng-bind='pagination.current_page - 1 ' 
					ng-show='pagination.current_page > 1'
					ng-click='pagination.current_page = pagination.current_page - 1; getEscuelas()' >
				</a>
				
				<a href="" ng-show='pagination.document_pages > 1' ng-bind='pagination.current_page' class='on'></a>
				
				<a href="" 
					ng-bind='pagination.current_page + 1'
					ng-show='pagination.current_page + 1 <= pagination.document_pages'
					ng-click='pagination.current_page = pagination.current_page + 1; getEscuelas()' >
				</a>
				
				<a  href="" 
					ng-bind='pagination.current_page + 2'
					ng-show='pagination.current_page + 2 <= pagination.document_pages && pagination.current_page == 1'
					ng-click='pagination.current_page = pagination.current_page + 2; getEscuelas()' >
				</a>

				<a  href="" 
					ng-show='pagination.current_page + 3 <=  pagination.document_pages'
					ng-click='pagination.current_page = pagination.current_page + 3; getEscuelas()' >
						&gt;
				</a>
				<a  href="" 
					ng-show='pagination.current_page + 2 < pagination.document_pages' 
					ng-click='pagination.current_page = pagination.document_pages; getEscuelas()' >
						Últimas &gt;
				</a>

			</div>	
		</div>
	</div>
</div>
