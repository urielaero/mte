<ul class="questions" ng-show="showPlanea">
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">1.</span> ¿Qué hago si no encuentro mi escuela?
		</p>
		<div class="question-content">
			<p>Nuestro sitio tiene perfiles de todas las escuelas primarias, secundarias y bachilleratos públicas y privadas registradas ante la SEP a nivel nacional durante el último ciclo escolar. Si intentaste buscar tu escuela por nombre y no te aparece en los resultados, intenta hacer una nueva búsqueda por zona geográfica. Si aún no encuentras tu escuela, escríbenos a contacto@mejoratuescuela.org y te ayudaremos a encontrarla.</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">2.</span> ¿Qué tan actualizada está la plataforma?
		</p>
		<div class="question-content">
			<p>MejoraTuEscuela.org se alimenta de las bases de datos más actualizadas que están disponibles. Como indicadores de desempeño académico se utilizan los resultados de PLANEA del último ciclo escolar (2015). La información sobre grupos, maestros, alumnos e infraestructura se basa en lo reportado en el Censo de Escuelas, Maestros y Alumnos de Educación Básica y Especial (CEMABE), realizado por el INEGI y la SEP en el ciclo escolar 2013/2014.
			</p>
			<p>La información sobre programas de apoyo del Gobierno Federal y de organizaciones de la sociedad civil (OSCs) se origina del CEMABE, así como de lo reportado en padrones oficiales de cada programa y por las organizaciones mismas.</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">3.</span> ¿Qué es la prueba PLANEA?
		</p>
		<div class="question-content">
			<p>El Plan Nacional para la Evaluación de los Aprendizajes (PLANEA) es un conjunto de pruebas diseñadas por el Instituto Nacional para la Evaluación de la Educación (INEE) para conocer el nivel de aprendizaje de los estudiantes en dos áreas de estudio, Lenguaje y Comunicación, y Matemáticas.
			<br>
			Existen varios tipos de evaluaciones dentro de PLANEA, las cuales se aplican con diferente periodicidad y a diferentes grupos de alumnos. Como indicadores de desempeño académico MejoraTuEscuela.org utiliza los resultados de la Evaluación de Logro referida a los Centros Escolares (ELCE), la cual se aplicó por primera vez en 2015. Esta prueba se realizó en todas las escuelas del país, seleccionando en cada una muestras representativas de alumnos de los  grados terminales de educación primaria (6°), secundaria (3°) y media superior (3°).
			<br>
			Puedes consultar más información sobre PLANEA en su sitio 
			<a href="http://www.planea.sep.gob.mx/">oficial.</a> </p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">4.</span>¿Qué significan los niveles de desempeño de los resultados de PLANEA? 
		</p>
		<div class="question-content">
			<p>
				Los resultados de la modalidad ELCE de PLANEA que están disponibles no reportan un puntaje por escuela o por alumno. Desafortunadamente, actualmente estos solamente incluyen el porcentaje de alumnos de cada escuela que se encuentra en cada uno de los cuatro niveles de desempeño establecidos por el INEE. 
			<br>
			
				La descripción genérica que da el INEE para estos niveles es la siguiente:
				<br>

				Nivel IV: Los estudiantes que se ubican en este nivel tienen un logro sobresaliente de los aprendizajes clave del currículum.
				<br>
				
				Nivel III: Los estudiantes que se ubican en este nivel tienen un logro satisfactorio de los aprendizajes clave del currículum.				<br>
				Nivel II: Los estudiantes que se ubican en este nivel tienen un logro apenas indispensables de los aprendizajes clave del currículum.				<br>
				Nivel I: Los estudiantes que se ubican en este nivel obtienen puntuaciones que representan un logro insuficiente de los aprendizajes clave del currículum, lo que refleja carencias fundamentales que dificultarán el aprendizaje futuro. 
				<br>

	Al aplicarse a cada materia evaluada, los niveles de desempeño hacen referencia a competencias y habilidades específicas. 


			
			
			</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">5.</span> 5. ¿Cómo se calcula la ubicación de una escuela en el semáforo de resultados educativos?
		</p>
		<div class="question-content">
			<p>
			Para ubicar a las escuelas se comparó el porcentaje de alumnos por nivel de desempeño de cada escuela con su distancia al promedio nacional. Es decir, se calculó la diferencia en cada nivel entre el promedio nacional y el porcentaje de la escuela. 
			<br>
			

			Para los dos niveles más altos de desempeño (niveles III y IV), se dio una calificación positiva a las escuelas cuyos porcentajes estuvieron por arriba del promedio y una calificación negativa a las que estuvieron por debajo. Para los dos niveles más bajos de desempeño (I y II) fue a la inversa: se dio una calificación negativa a las escuelas cuyos resultados estuvieran por arriba del promedio y una calificación positiva a aquellas que estuvieran por debajo. 
			<br>
			

			Además, se le dio más peso al nivel más bajo (I) y al más alto (IV) que a los intermedios, ya que consideramos mucho más valioso tener más alumnos en el nivel IV que en el III, y mucho peor tener más alumnos en el nivel I que en el II. Así, de los cuatro niveles, se ponderaron con mayor peso para la calificación promedio a los niveles I y IV con 35% cada uno y con 15% los niveles II y III.
			<br>

			Para obtener una calificación global por escuela, las calificaciones  de matemáticas y de español se promediaron ponderando con peso de 80% y 20% respectivamente. Esta calificación se expresó en una escala de 0 a 100 para facilitar su interpretación, donde 100 corresponde a la calificación de la escuela más alta y 0 a la más baja. 
			<br>

			Si quieres conocer a detalle la metodología detrás de nuestro sitio te invitamos a leer nuestra ficha metodológica <a href="/metodologia">aquí</a>.
			
			</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">6.</span>¿Cómo se calcula la posición estatal de mi escuela? 
		</p>
		<div class="question-content">
			<p>
			Para generar las posiciones estatales hacemos una lista de todas las escuelas del estado, de cada nivel educativo, ordenada por sus calificaciones globales. La calificación global de una escuela está basada en un promedio ponderado de sus resultados de matemáticas y español en la prueba PLANEA. Si quieres conocer a detalle la metodología detrás de nuestro sitio te invitamos a leer nuestra ficha metodológica <a href="/metodologia">aquí</a>.
			
			</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">7.</span> ¿Por qué mi escuela tiene una mala calificación en el semáforo de resultados educativos si mi hijo está obteniendo buenas calificaciones en la escuela?
		</p>
		<div class="question-content">
			<p>
			
			Las calificaciones individuales de tu hija o hijo son independientes del desempeño de la escuela en su conjunto. En su boleta de calificaciones, tu hijo puede tener resultados muy altos, pero eso no quiere decir que está cumpliendo con los estándares nacionales de aprendizaje o que la escuela, en su conjunto, los esté cumpliendo. 
			<br>
			

			Te sugerimos revisar los resultados de tu hijo en la prueba PLANEA. Su calificación te puede dar un mejor indicio de su nivel de aprendizaje comparado con otros estudiantes de su edad. 
			<br>


			Puedes consultar los resultados en:
			<br>


			Para primaria y secundaria: http://planea.sep.gob.mx/ba/
			<br>
			Para bachillerato: http://planea.sep.gob.mx/ms/
			
			</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">8.</span> ¿Qué quiere decir el triángulo negro junto al nombre de mi escuela (o en el lugar del semáforo de resultados educativo)?
		</p>
		<div class="question-content">
			<p>
			El triángulo negro junto al nombre de una escuela indica que en ese plantel no se aplicó la prueba PLANEA. Por lo tanto, no tenemos manera de obtener información para estimar su calidad educativa. 
			<br>
			

			Si este es el caso de tu escuela, te invitamos a que te acerques con tu director para pedirle que busque que la prueba se aplique en tu escuela en la siguiente oportunidad.
			
			
			</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">9.</span>¿Qué quiere decir el triángulo gris junto al nombre de mi escuela (o en el lugar del semáforo de resultados educativo)? 
		</p>
		<div class="question-content">
			<p>El triángulo gris indica que, aunque la escuela tomó la prueba PLANEA, la muestra de alumnos que la respondieron no es representativa de todo el plantel, por lo que sus resultados no necesariamente reflejan la calidad educativa de la escuela en su conjunto. </p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">10.</span>¿Qué quiere decir el triángulo rojo junto al nombre de mi escuela (o en el lugar del semáforo de resultados educativo)? 
		</p>
		<div class="question-content">
			<p>PLANEA utiliza técnicas avanzadas para garantizar el control de calidad de los resultados individuales y por grupo. El INEE identifica como  resultados “poco confiables” cualquier tendencia que indique la existencia de copia, dictado de respuestas y otras prácticas fraudulentas. El símbolo de precaución junto al nombre de una escuela indica que la SEP considera que se encontró un número “excesivo” de respuestas similares entre estudiantes que tomaron la prueba en la misma aula.
			
			Si tu escuela aparece con triángulo rojo, invitamos a que te acerques con el director o directora y los maestros para que te expliquen qué están haciendo para solucionar estas problemáticas.
			</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">11.</span> Mi organización tiene programas de apoyo para escuelas, ¿cómo la puedo mostrar en MejoraTuEscuela.org? 
		</p>
		<div class="question-content">
			<p>¡Nos encanta conocer iniciativas y programas nuevos! Por favor contacta a nuestro equipo enviando un correo a contacto@mejoratuescuela.org</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">12.</span>Mi escuela cuenta con página de internet ¿se puede incluir en el perfil de MejoraTuEscuela.org? 
		</p>
		<div class="question-content">
			<p>Los sitios de internet de las escuelas se pueden incluir en los perfiles. Queremos que la ciudadanía cuente con toda la información necesaria para conocer más sobre los centros educativos del país. Manda un correo a: contacto@mejoratuescuela.org con los datos de tu escuela, la dirección y será incluida.</p>
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">13.</span> ¿Las bases de datos están disponibles y son abiertas para uso de terceros?
		</p>
		<div class="question-content">
			<p>Las bases que utiliza MejoraTuEscuela.org están abiertas y disponibles para consulta. Si te interesa, consulta nuestro apartado de <a href="http://www.mejoratuescuela.org/bases">Datos Abiertos</a> o comunícate con nuestro equipo en la dirección electrónica pablo.clark@imco.org.mx </p>
			
		</div>
	</li>
	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">14.</span>¿Cómo puedo crear mi propia petición? 
		</p>
		<div class="question-content">
			<p>Si quieres crear tu propia petición te invitamos a visitar el sitio de nuestros aliados: www.Change.org Change.org® es un sitio independiente y apartidista que permite que cualquier persona, desde cualquier lugar del mundo, pueda iniciar una campaña para generar cambios sociales en su comunidad.
			<br>
			
			Para iniciar una petición deberás registrarte en el sitio de Change.org, describir la problemática que deseas compartir, escoger a qué autoridades quieres que se le envíe tu petición, y finalmente compartirla con tus amigos y conocidos por medio de correos electrónicos o redes sociales. Si quieres que tu petición se muestre en MejoraTuEscuela.org, mándanos la liga a tu petición a: contacto@mejoratuescuela.org y con mucho gusto la revisaremos. Mejora tu escuela busca promover iniciativas y peticiones ciudadanas para mejorar la calidad de la educación en México.</p>
			
		</div>
	</li>

	<li>
		<p class="question" ng-click="toggleQuestion($event)">
			<span class="number">15.</span>  Cuando abro el archivo en Excel de la descarga de las bases de datos del Censo Educativo, la información me aparece en una sola celda, ¿cómo puedo abrirlo?
		</p>
		<div class="question-content">
			<p>El archivo que se descarga desde Mejora tu escuela tiene formato CSV separado por punto y coma (";"). Para poder abrirlo, tienen que importarlo a Excel. En el siguiente link <a href="https://www.youtube.com/watch?v=-VS-RVwGHZA">https://www.youtube.com/watch?v=-VS-RVwGHZA</a> pueden ver un tutorial que les ayudará a manejar este archivo o leer las instrucciones oficiales en <a href="http://office.microsoft.com/es-mx/excel-help/import-or-export-text-txt-or-csv-files-HP010342598.aspx">http://office.microsoft.com/es-mx/excel-help/import-or-export-text-txt-or-csv-files-HP010342598.aspx</a>.</p>
		</div>
	</li>
</ul>

