<div class="mtev1-theme">
	<div class="container bases post" ng-controller='fileController'>
		<img src="/templates/mtev2/img/bases/banner.jpg" alt="Bases de datos censo" style='margin-bottom:-2px' />
		<div class='container quienes_somos'><div class='wrap_text'>
		<p><b>Censo Educativo</b></p>
		<p>En diciembre de 2013, la Secretaría de Educación Pública, para dar cumplimiento a uno de los mandatos de la Reforma Educativa, puso en marcha el portal del Sistema de Información y Gestión Educativa, en el cual se da a conocer información sobre el sistema educativo nacional. Este sistema, entre otras cosas, liberó bases de datos adicionales del Censo de Escuelas, Maestros y Alumnos de Educación Básica y Especial, entre las que destaca la base de datos de personal.
		</p>
		<br>
		

		<p>Aquí puedes descargar:</p>
		<ol>
			<li><a href="http://siged.sep.gob.mx/SIGED/content/conn/WCPortalUCM/path/Contribution%20Folders/PortalSIGED/Descargas/Datos%20Abiertos/Censo/Alumnos/ALUMNOS_CT_CENSADOS.zip">Alumnos</a>
			<li><a href="http://siged.sep.gob.mx/SIGED/content/conn/WCPortalUCM/path/Contribution%20Folders/PortalSIGED/Descargas/Datos%20Abiertos/Censo/Escuelas/CATALOGO_CT.zip">Escuelas</a>
			<li><a href="http://siged.sep.gob.mx/SIGED/content/conn/WCPortalUCM/path/Contribution%20Folders/PortalSIGED/Descargas/Datos%20Abiertos/Censo/Personal/PERSONAL_CT_CENSADOS.zip">Personal Censado</a>
			<li><a href="http://siged.sep.gob.mx/SIGED/content/conn/WCPortalUCM/path/Contribution%20Folders/PortalSIGED/Descargas/Datos%20Abiertos/Censo/Personal/PERSONAL_FUNCIONES_CT_CENSADOS.zip">Personal Funciones</a>
			<li><a href="http://siged.sep.gob.mx/SIGED/content/conn/WCPortalUCM/path/Contribution%20Folders/PortalSIGED/Descargas/Datos%20Abiertos/Censo/Personal/PERSONAL_MATERIAS_CT_CENSADOS.zip">Personal Materias</a>
			<li><a href="http://siged.sep.gob.mx/SIGED/content/conn/WCPortalUCM/path/Contribution%20Folders/PortalSIGED/Descargas/Datos%20Abiertos/Censo/Personal/PERSONAL_PLAZAS_CT_CENSADOS.zip">Personal Plazas</a>
			<li>Fuente: SIGED, SEP. 2014</li>
			<hr>
			<br>
			<li><a href="http://storage.googleapis.com/cemabe/TR_INMUEBLES.DBF.zip">Archivo Inmueble</a>: Datos sobre características del inmueble de todas las escuelas excepto CONAFE.</li>
			<li><a href="http://storage.googleapis.com/cemabe/TR_CENTROS.DBF.zip">Archivo Centros de Trabajo</a>: Datos sobre características de los centros de trabajo (escuelas) excepto CONAFE. </li>
			<li><a href="http://storage.googleapis.com/cemabe/TR_CONAFE.DBF.zip">Archivo CONAFE</a>: Datos sobre características del inmueble y centros de trabajo de esta modalidad.</li>
			<li><a href="http://9f0fda65d2ce0b27aaf2-105ac619070a816e0b7aa45dafa2da41.r45.cf1.rackcdn.com/cemabe/Diccionario_CEMABE.xlsx">Descripción de variables de cuestionarios</a></li>
			<li>Fuente: INEGI. 2014</li>
			<br>
			
			<li>¿No puedes abrir los archivos? Visita nuestra sección de <a href="http://www.mejoratuescuela.org/preguntas-frecuentes#pregunta14" target="_blank">preguntas frecuentes</a>.</li>
		</ol>
		<hr>
		<br>
		
		<p><b>Supervisores Escolares</b></p>
		<p>Como parte de la herramienta Ventanilla Escolar, el equipo de Mejora Tu Escuela elaboró una base de datos con información sobre las supervisiones escolares del país, la cual incluye sus datos de contacto y otros datos generales. La información de esta base de supervisores se obtuvo a través de diversas solicitudes de información a las autoridades educativas de cada estado, realizadas en el primer semestre de 2016. Mejora Tu Escuela hace pública esta base para apoyar a los usuarios del sitio a identificar al supervisor de su plantel, quien es un enlace importante en la resolución de problemáticas en las escuelas. </p>
		<hr>
		
		</div></div>

		<img src="/templates/mtev2/img/bases/banerdescarga.jpg" alt="pasos" />
		<form class='file-search-form' method='get' action='#'   >
				<label>Bases de datos por estado</label>
				<input type='text' name='state' ng-model='searchText' placeholder='Buscar estado' />
				<input type='submit' value='' class='submit' />
				<div class='clear'></div>
		</form>
		
		<table class='file-table'>
			<thead>
				<tr>
					<th>Estado</th>
					<th>Archivos</th>
					<th>Codificación</th>
					<th>Elegir servicio de descarga</th>
					<th class='download'>Descargar</th>
				</tr>
			</thead>
			<tbody ng-cloak ng-repeat='entidad in entidades | filter:searchText' >
				<tr class='space'><td></td><td></td><td></td><td></td><td></td></tr>
				<tr  class='state'>
					<td>
						<img ng-src='/templates/mtev1/img/bases/estados/{{entidad.entidad}}.png' alt='{{entidad.nombre}}' />
						<p class='title1' ng-bind='entidad.nombre'></p>
					</td>
					<td>
						<select ng-options='opt for opt in options' ng-model='entidad.census' ></select>
					</td>
					<td>
						<br>
						
						<p class='options' ng-repeat="(name, format) in formats" ng-show="formatDis(entidad, format, 'r')">
							<span class='checkbox pull-left' ng-click='entidad.format = format' ng-class='entidad.format == format ? "selected":""'></span>
							{{name}}
						</p>
						<div class='clear'></div>
					</td>
					<td class='services'>
							<div class='service' ng-repeat="mirror in mirrors" ng-init="mirrorLow = mirror.toLowerCase()" ng-show="formatDis(entidad, entidad.format, mirrorLow.charAt(0))">
								<div class='checkbox' ng-click='entidad.service = mirrorLow.charAt(0)' ng-class='entidad.service == mirrorLow.charAt(0) ? "selected":""'></div>
								<div ng-class="['icon', mirrorLow]"></div>
								<p>{{mirror}}</p>
							</div>
					</td>
					<td class='download'>
						<p><a ng-href='{{getLink(entidad)}}' download></a></p>
					</td>
				</tr>
			</tbody>

		</table>

	</div>
</div>
