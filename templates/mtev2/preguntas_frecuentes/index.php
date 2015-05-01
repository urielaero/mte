<div class="container post faq" ng-controller="faqCTL">
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Preguntas frecuentes</a>
	</div>
	<div layout="row" class="post-title">
		<div flex="10" class="icon-container" hide-sm>
			<div class="icon-wrapper vertical-align-center horizontal-align-center">
				<i class="icon-escuela-01"></i>
			</div>
		</div>
		<h1 flex="90"><strong>Preguntas frecuentes</strong></h1>
	</div>
	<ul class="questions">
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
				<p>MejoraTuEscuela.org se alimenta de las bases de datos más actualizadas que están disponibles. Para medir desempeño académico se utilizan los resultados de ENLACE del último ciclo escolar (2013). La información sobre grupos, maestros, alumnos e infraestructura se basa en lo reportado en el Censo de Escuelas, Maestros y Alumnos de Educación Básica y Especial, realizado por el INEGI y la SEP en el ciclo escolar 2013/2014. </p>
				<p>La información sobre programas de apoyo del Gobierno Federal y de organizaciones de la sociedad civil (OSCs) se origina del censo educativo así como de lo reportado en padrones oficiales de cada programa y por las organizaciones mismas.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">3.</span> ¿Qué es la prueba ENLACE?
			</p>
			<div class="question-content">
				<p>La Evaluación Nacional de Logro Académico en Centros Escolares (ENLACE) es una prueba del Sistema Educativo Nacional, cuyo objetivo es contribuir al avance educativo de los alumnos mexicanos de cada centro escolar y entidad federativa. Hasta el ciclo escolar 2012/2013, la prueba se aplicaba a los alumnos de primaria de tercer a sexto grado. También hasta el 2013, la prueba se aplicó a jóvenes de primero, segundo y tercero de secundaria. En nivel medio superior, la prueba sigue vigente y se administra a los estudiantes que cursan el último año. </p>
				<p>Las pruebas cubren temas en función de los planes y programas de estudios oficiales en los campos de comunicación y comprensión lectora en español y en el campo de las matemáticas. La prueba incluye también una tercer asignatura que cambia cada año, por ejemplo, en el 2008 fue ciencias, en el 2009 formación cívica, en el 2010 historia, en el 2011 geografía y en el 2012 nuevamente ciencias. </p>
				<p>El propósito de ENLACE es generar una sola escala de carácter nacional que proporcione información comparable de los conocimientos y habilidades que tienen los estudiantes en los temas evaluados. Para más información sobre la prueba, visita: <a href="http://enlace.sep.gob.mx/">http://enlace.sep.gob.mx/</a></p>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">4.</span> ¿Cómo se calcula la posición estatal de mi escuela?
			</p>
			<div class="question-content">
				<p>Para generar las posiciones hacemos una lista de todas las escuelas del estado, de cada nivel educativo, por sus calificaciones globales. La calificación global de una escuela está basada en un promedio ponderado de sus resultados de matemáticas y español en la prueba ENLACE del último año. Si quieres conocer a detalle la metodología detrás de nuestro sitio te invitamos a leer nuestra ficha metodológica <a href="/metodologia">aquí</a>.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">5.</span> ¿Cómo se calcula la ubicación de una escuela en el semáforo educativo?
			</p>
			<div class="question-content">
				<p>Ya que tenemos los promedios globales de cada escuela, graficamos la distribución de escuelas y generamos los cortes para el semáforo educativo. Los cortes son los siguientes: </p>
				<p><strong>Para primaria 2013:</strong></p>
				<p>Excelente: calificación por encima de 662 puntos.</p>
				<p>Bien: por encima de 601 pero menos de 662.</p>
				<p>De panzazo: por encima de 559 pero menos de 601.</p>
				<p>Reprobado: menos de 559 de promedio.</p>
				<p><strong>Para secundaria 2013:</strong></p>
				<p>Excelente: calificación por encima de 591 puntos.</p>
				<p>Bien: por encima de 544 pero menos de 591.</p>
				<p>De panzazo: por encima de 511 pero menos de 544.</p>
				<p>Reprobado: menos de 511 de promedio.</p>
				<p><strong>Para bachillerato 2013:</strong></p>
				<p>Excelente: calificación por encima de 632 puntos.</p>
				<p>Bien: por encima de 580 pero menos de 632.</p>
				<p>De panzazo: por encima de 551 pero menos de 580.</p>
				<p>Reprobado: menos de 551 de promedio.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">6.</span> ¿Por qué mi escuela tiene una mala calificación en el semáforo educativo si mi hij@ está obteniendo buenas calificaciones en la escuela?
			</p>
			<div class="question-content">
				<p>Las calificaciones individuales de tu hij@ son independientes del desempeño de la escuela en conjunto o de su calidad educativa. En la boleta de calificaciones de la escuela, tu hij@ puede tener resultados muy altos, pero eso no quiere decir que está cumpliendo con los estándares nacionales de aprendizaje o que la escuela, en su conjunto, los esté cumpliendo. Te sugerimos revisar los resultados de tu hij@ en la prueba ENLACE, su calificación te puede dar un mejor estimado de su nivel de aprendizaje comparad@ con otros estudiantes de su edad. Puedes conocer los resultados en:</p>
				<p>Para primaria y secundaria: <a href=" http://www.enlace.sep.gob.mx/ba/"> http://www.enlace.sep.gob.mx/ba/</a></p>
				<p>Y para bachillerato en: <a href="http://www.enlace.sep.gob.mx/ms/">http://www.enlace.sep.gob.mx/ms/
				</a></p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">7.</span> ¿Qué quiere decir el triángulo negro junto al nombre de mi escuela (o en el lugar del semáforo educativo)?
			</p>
			<div class="question-content">
				<p>El triángulo negro junto al nombre de una escuela indica que la escuela no administra la prueba ENLACE a sus alumnos. Por lo tanto, no tenemos manera de obtener información para definir su calidad educativa. Si este es el caso para tu escuela, te invitamos a que firmes una petición para que la prueba ENLACE se administre a todas las escuelas de tu estado. Encuentra las distintas peticiones aquí.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">8.</span> ¿Qué quiere decir el triángulo gris junto al nombre de mi escuela (o en el lugar del semáforo educativo)?
			</p>
			<div class="question-content">
				<p>El triángulo gris indica que no todos los grados de la escuela toman la prueba ENLACE. Para los años que no tenemos resultado se asigna un cero, por lo tanto, el promedio de la escuela tiende a ser muy bajo. Esta situación se puede dar en dos ocasiones:</p>
				<p>La escuela toma la decisión de que uno de sus grados no tome la prueba ENLACE.</p>
				<p>La escuela es nueva y aún no tiene estudiantes en todos los grados.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">9.</span>  ¿Qué quiere decir el triángulo rojo junto al nombre de mi escuela (o en el lugar del semáforo educativo)?
			</p>
			<div class="question-content">
				<p>La prueba ENLACE utiliza tecnologías avanzadas para garantizar el control de calidad de los resultados individuales y por grupo. La SEP identifica como “copia u otras acciones inaceptables” cualquier tendencia que indique la existencia de copia, dictado de respuestas y otras prácticas fraudulentas. El símbolo de precaución junto al nombre de una escuela indica que la SEP considera más del 10% de las pruebas ENLACE administradas por esa escuela como “no confiables” o “fraudulentas”. </p>
				<p>Si tu escuela aparece con triángulo rojo, invitamos a que te acerques con el director o directora y los maestros para que te expliquen qué están haciendo para solucionar estas problemáticas.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">10.</span>  Mi organización tiene programas de apoyo para escuelas, ¿cómo la puedo mostrar en MejoraTuEscuela.org?
			</p>
			<div class="question-content">
				<p>Nos encanta conocer iniciativas y programas nuevos. Por favor contacta a nuestra coordinadora de contenidos, Ariadna Camargo: ariadna.camargo@imco.org.mx</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">11.</span>  Mi escuela cuenta con página de internet ¿se puede incluir en el perfil de MejoraTuEscuela.org?
			</p>
			<div class="question-content">
				<p>Las sitios de internet de las escuelas se pueden incluir en los perfiles, queremos que la ciudadanía cuente con toda la información necesaria para conocer más sobre los centros educativos del país. Manda un correo a: contacto@mejoratuescuela.org con la dirección y será incluida.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">12.</span>  ¿Las bases de datos están disponibles y son abiertas para uso de terceros?
			</p>
			<div class="question-content">
				<p>Las bases que utiliza MejoraTuEscuela.org están abiertas y disponibles para consulta. Si te interesa conectarte a nuestra API, por favor contacta a nuestro coordinador de tecnología, Francisco Mekler: francisco.mekler@imco.org.mx</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">13.</span>  ¿Cómo puedo crear mi propia petición?
			</p>
			<div class="question-content">
				<p>Si quieres crear tu propia petición te invitamos a visitar el sitio de nuestros aliados: www.Change.org Change.org® es un sitio independiente y apartidista que permite que cualquier persona, desde cualquier lugar del mundo, pueda iniciar una campaña para generar cambios sociales en su comunidad. </p>
				<p>Para iniciar una petición deberás registrarte en el sitio de Change.org, describir la problemática que deseas compartir, escoger a qué autoridades quieres que se le envíe tu petición, y finalmente compartirla con tus amigos y conocidos por medio de correos electrónicos o redes sociales. Si quieres que tu petición se muestre en MejoraTuEscuela.org, mándanos la liga a tu petición a: contacto@mejoratuescuela.org y con mucho gusto la revisaremos. Mejora tu escuela busca promover iniciativas y peticiones ciudadanas para mejorar la calidad de la educación en México.</p>
			</div>
		</li>
		<li>
			<p class="question" ng-click="toggleQuestion($event)">
				<span class="number">14.</span>  Cuando abro el archivo en Excel de la descarga de las bases de datos del Censo Educativo, la información me aparece en una sola celda, ¿cómo puedo abrirlo?
			</p>
			<div class="question-content">
				<p>El archivo que se descarga desde Mejora tu escuela tiene formato CSV separado por punto y coma (";"). Para poder abrirlo, tienen que importarlo a Excel. En el siguiente link <a href="https://www.youtube.com/watch?v=-VS-RVwGHZA">https://www.youtube.com/watch?v=-VS-RVwGHZA</a> pueden ver un tutorial que les ayudará a manejar este archivo o leer las instrucciones oficiales en <a href="http://office.microsoft.com/es-mx/excel-help/import-or-export-text-txt-or-csv-files-HP010342598.aspx">http://office.microsoft.com/es-mx/excel-help/import-or-export-text-txt-or-csv-files-HP010342598.aspx</a>.</p>
			</div>
		</li>
	</ul>
</div>
