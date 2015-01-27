<div class="container post">
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Metodología</a>
	</div>
	<div layout="row" class="post-title">
		<div flex="10" class="icon-container" hide-sm>
			<div class="icon-wrapper vertical-align-center horizontal-align-center">
				<i class="icon-metodologia"></i>
			</div>
		</div>
		<h1 flex="90"><strong>Metodología</strong></h1>
	</div>
	<div class="post-content">
		<h2>Nota metodológica para educación básica.</h2>
		
		<h3><strong>Las calificaciones globales por centro escolar (CCT) se calcularon de la siguiente manera:</strong></h3>
		<p>En las bases de datos con resultados desglosados a nivel alumno, en primer lugar agrupamos los resultados por materia, matemáticas y español. Para cada uno de los dos dominios hicimos promedios por grado escolar. Posteriormente, agrupamos los promedios de cada materia por nivel escolar, es decir, para primaria, agrupamos tercero, cuarto, quinto y sexto. Para secundaria, primero, segundo y tercero. Así obtuvimos el promedio por materia por cada centro escolar.</p>
		<p>Los promedios de matemáticas y de español por cada centro escolar están ponderados con pesos 80-20. A matemáticas le asignamos un peso mucho mayor porque la distribución de calificaciones de matemáticas tienen una varianza mucho menor y una distribución de probabilidad diferente a las calificaciones de español. Esto nos lleva a pensar que los resultados de las dos materias surgen de procesos cognitivos distintos; es decir, el buen dominio de la lengua española se aprende en casa y el buen dominio de las matemáticas se aprende en la escuela.</p>
		<p>Para cada escuela, se calcula una calificación global promediando las cifras ponderadas de español y matemáticas. Esto resulta en una lista de todos los centros escolares (identificados por su código CCT) con su calificación global correspondiente. Las posiciones estatales y nacionales están basadas en esta lista.</p>
		
		<h3><strong>Los cortes para los cuatro distintos niveles de calidad educativa (“excelente”, “bien”, “de panzazo”, “reprobados”) se calcularon de la siguiente manera:</strong></h3>
		<p> Primero, de la gráfica de distribución eliminamos las escuelas en las que alguno de los grados escolares no tomó la prueba con el fin de asegurar que la distribución no estuviera sesgada hacia abajo. Así definimos los cortes.</p>
		<p>El 50% de las escuelas con las calificaciones más bajas en la distribución teórica corresponden al nivel “reprobado”. El siguiente 20% de las escuelas se clasifican en el nivel “de panzazo”, el siguiente 20% entran al nivel “bien” y finalmente, el mejor 10% de las escuelas están en el nivel “excelente”.</p>
		<p>Para el 2013, los cortes para primaria son: </p>
		<p>662 &lt; Excelente </p>
		<p>601 &lt; Bien &lt; 662 </p>
		<p>559 &lt; De panzazo &lt; 601 </p>
		<p>Reprobado &lt; 559</p>
		<br/>
		<p>Para el 2013, los cortes para secundaria son: </p>
		<p>591 &lt; Excelente </p>
		<p>544 &lt; Bien &lt; 591 </p>
		<p>511 &lt; De panzazo &lt; 544 </p>
		<p>Reprobado &lt; 511</p>
		
		<h3><strong>Nota metodológica para educación media superior</strong></h3>
		<p>A diferencia de las bases de datos para educación básica, en educación media superior (bachillerato) no se reportan las calificaciones exactas a nivel alumno. La base indica, simplemente, en qué rango de desempeño se ubicó el resultado del alumno. </p>
		<p>Para poder generar calificaciones, asignamos una calificación intermedia para cada una de esas categorías similar a las calificaciones que vemos en primaria y secundaria para estar en cada uno de esos rangos. Asignamos entonces ese resultado intermedio a cada uno de los alumnos dependiendo de los rangos en los que se reporta que se ubicó su calificación.</p>
		<p>Con estos resultados pudimos continuar con la metodología descrita para educación básica, en donde agrupamos por materia, por grado, y finalmente por centro escolar ponderando los resultados de matemáticas y español con un peso de 80-20. Las calificaciones globales se utilizaron para generar las posiciones estatales y nacionales. </p>
		<p>Al momento de graficar los resultados por centro escolar, la distribución para educación media superior fue muy similar a las distribuciones para primaria y secundaria, lo que facilitó que se siguiera la misma metodología en la asignación de cortes para los distintos niveles de calidad.</p>
		<p>Para el 2014, los cortes para bachillerato son: </p>
		<p>632 &lt; Excelente </p>
		<p>580 &lt; Bien &lt; 632 </p>
		<p>551 &lt; De panzazo &lt; 580 </p>
		<p>Reprobado &lt; 551</p>
		<br/>

		<p>Las siguientes gráficas muestran las distribuciones teóricas para los distintos niveles educativos. Los cortes, y por lo tanto, niveles de calidad educativa se identifican por color (verde= excelente, amarillo= bien, naranja= de panzazo, rojo= reprobado)</p>
		
		<p class="charts-images">
				<a href="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/metodologia_Primaria2012Ultimo.png">
					<?php $this->print_img_tag('metodologia/Primaria2012Ultimo.png');?>
				</a>
				<a href="#http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/metodologia_Secundaria2012Ultimo.png">
					<?php $this->print_img_tag('metodologia/Secundaria2012Ultimo.png');?>
				</a>
				<a href="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/metodologia_Bachillerato2013.png">
					<?php $this->print_img_tag('metodologia/Bachillerato2013.png');?>					
				</a>	
		</p>

		<h3><strong>Metodología para determinar los resultados por estado</strong></h3>
		<p>Para determinar las posiciones estatales se utilizaron los promedios ponderados (matemáticas 80- español 20) de todas las escuelas del estado para cada nivel escolar.</p>
		<p>A las escuelas que están categorizadas como “no confiables” por tener una incidencia de copia por arriba del 10% se les asignó una calificación de cero. De igual manera, las escuelas que no tomaron la prueba ENLACE tuvieron una calificación de cero. Por último, las escuelas en donde no todos los años de la escuela tomaron la prueba ENLACE no se consideran para el promedio estatal.</p>
		<p>Los promedios estatales de primaria, secundaria y bachillerato se promedian entre tres para generar una calificacion global del estado.</p>		

		<h3><strong>Otras consideraciones y preguntas frecuentes acerca de la metodología:</strong></h3>
		<ul>
			<li>
				1. ¿Por qué no utilizan los cortes que usa la SEP?
				<p>Los cortes de la SEP están diseñados para categorizar alumnos, no escuelas. En otras palabras, que un alumno obtenga una calificación de 708 en una prueba, lo cual lo ubicaría en el nivel “excelente”, es mucho más fácil a que una escuela obtenga esa misma calificación como promedio de todos sus estudiantes. Por lo tanto, no sería correcto extrapolar los cortes para resultados individuales de alumnos a una base de promedios por escuela.</p>
			</li>
			<li>
				2. ¿Cómo se incorporan los indicadores de resultados no confiables?
				<p>En las bases de datos de educación básica, la SEP incluye un indicador que identifica pruebas de alumnos en donde hay evidencia de prácticas de copia. Estas pruebas las identifica como “no confiables”. A las escuelas en las que más del 10% de los alumnos tienen resultados “no confiables”, MejoraTuEscuela.org les asigna un ícono de “no confiable” en lugar de su calificación correspondiente en el semáforo educativo. Nuestro mensaje en este sentido es que una escuela en donde hay altos porcentajes de copia merece una clasificación mucho peor que una escuela honesta con desempeños malos.</p>
			</li>
		</ul>
	</div>
</div>