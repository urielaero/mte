<div class="container califica" ng-controller="escuelaCTL">
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">Escuela</a>
		<a href="#">Guanajuato</a>
		<a href="#">Preparatoria Carlos Navarro</a>
	</div>
	<div class="menu-top">
		<div layout="row" layout-sm="column" class="menu-row">
			<div class="profile-title" flex="70" flex-sm="100">
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
		</div>
	</div>
    <ng-switch on="selectedIndex" class="tabpanel-container">
        <div role="tabpanel" id="califica-content" aria-labelledby="tab1" ng-switch-when="0" md-swipe-left="next()" md-swipe-right="previous()" >
			<h1 class="green-title">Califica tu escuela seleccionando para cada campo una calificación del <strong>1-10</strong>.<br/>Estas calificaciones se promedian para generar la calificación general de tu escuela</h1>

			<div class="tabs">
			    <md-tabs md-selected="selectedQuestion">
			    	<md-tab aria-controls="tab1-content">
			    		<i class="icon-check-01"></i>
			      	</md-tab>
			      	<md-tab class="q2" aria-controls="tab2-content">
			      		<i class="icon-programaapoyo-01"></i>
			      	</md-tab>
			      	<md-tab class="q3" aria-controls="tab2-content">
			      		<i class="icon-desk-01"></i>
			      	</md-tab>
			      	<md-tab class="q4" aria-controls="tab2-content">
			      		<i class="icon-familia-01"></i>
			      	</md-tab>
			      	<md-tab class="q5" aria-controls="tab2-content">
			      		<i class="icon-buscar-01"></i>
			      	</md-tab>
			      	<md-tab class="q6" aria-controls="tab2-content">
			      		<i class="icon-escuela-01"></i>
			      	</md-tab>
			    </md-tabs>				
			</div>
			<div class="questions-box">
			    <ng-switch on="selectedQuestion" class="tabpanel-container">
			        <div role="tabpanel" class="question-content" aria-labelledby="tab1" ng-switch-when="0">
			        	<div class="text">
			        		<h3>Asistencia de los maestros</h3>
							<p>¿Los maestros faltan a clases constantemente o siempre estan en el aula?</p>
							<p>1 = "Faltan constantemente"</p>
							<p>10 = "Nunca faltan"</p>
						</div>
						<div class="ans-row" layout="row">
							<div flex class="ans">1</div>
							<div flex class="ans">2</div>
							<div flex class="ans">3</div>
							<div flex class="ans">4</div>
							<div flex class="ans">5</div>
							<div flex class="ans">6</div>
							<div flex class="ans">7</div>
							<div flex class="ans">8</div>
							<div flex class="ans">9</div>
							<div flex class="ans">10</div>
						</div>
					</div>
			        <div role="tabpanel" class="question-content" aria-labelledby="tab1" ng-switch-when="1">
			        	<div class="text">
			        		<h3>Preparacion de los maestros</h3>
							<p>¿Qué tan preparados y capacitados están los maestros de tu escuela?</p>
							<p>1 = "Poco preparados"</p>
							<p>10 = "Muy preparados"</p>
						</div>
						<div class="ans-row" layout="row">
							<div flex class="ans">1</div>
							<div flex class="ans">2</div>
							<div flex class="ans">3</div>
							<div flex class="ans">4</div>
							<div flex class="ans">5</div>
							<div flex class="ans">6</div>
							<div flex class="ans">7</div>
							<div flex class="ans">8</div>
							<div flex class="ans">9</div>
							<div flex class="ans">10</div>
						</div>
					</div>
			        <div role="tabpanel" class="question-content" aria-labelledby="tab1" ng-switch-when="2">
			        	<div class="text">
			        		<h3>Participación de padres de familia</h3>
							<p>¿La escuela cuenta con las instalaciones necesarias para dar clases?</p>
							<p>1 = "Inadecuadas"</p>
							<p>10 = "Muy buenas"</p>
						</div>
						<div class="ans-row" layout="row">
							<div flex class="ans">1</div>
							<div flex class="ans">2</div>
							<div flex class="ans">3</div>
							<div flex class="ans">4</div>
							<div flex class="ans">5</div>
							<div flex class="ans">6</div>
							<div flex class="ans">7</div>
							<div flex class="ans">8</div>
							<div flex class="ans">9</div>
							<div flex class="ans">10</div>
						</div>
					</div>
			        <div role="tabpanel" class="question-content" aria-labelledby="tab1" ng-switch-when="3">
			        	<div class="text">
			        		<h3>Relación con padres de familia</h3>
							<p>¿Cómo es la relación de los maestros y director con los padres de familia?</p>
							<p>1 = "Mala"</p>
							<p>10 = "Muy buena"</p>
						</div>
						<div class="ans-row" layout="row">
							<div flex class="ans">1</div>
							<div flex class="ans">2</div>
							<div flex class="ans">3</div>
							<div flex class="ans">4</div>
							<div flex class="ans">5</div>
							<div flex class="ans">6</div>
							<div flex class="ans">7</div>
							<div flex class="ans">8</div>
							<div flex class="ans">9</div>
							<div flex class="ans">10</div>
						</div>
					</div>
			        <div role="tabpanel" class="question-content" aria-labelledby="tab1" ng-switch-when="4">
			        	<div class="text">
			        		<h3>Honestidad y transparencia</h3>
							<p>¿Los maestros faltan a clases constantemente o siempre estan en el aula?</p>
							<p>1 = "Faltan constantemente"</p>
							<p>10 = "Nunca faltan"</p>
						</div>
						<div class="ans-row" layout="row">
							<div flex class="ans">1</div>
							<div flex class="ans">2</div>
							<div flex class="ans">3</div>
							<div flex class="ans">4</div>
							<div flex class="ans">5</div>
							<div flex class="ans">6</div>
							<div flex class="ans">7</div>
							<div flex class="ans">8</div>
							<div flex class="ans">9</div>
							<div flex class="ans">10</div>
						</div>
					</div>
			        <div role="tabpanel" class="question-content" aria-labelledby="tab1" ng-switch-when="5">
			        	<div class="text">
			        		<h3>Infraestructura de la escuela</h3>
							<p>¿Los maestros faltan a clases constantemente o siempre estan en el aula?</p>
							<p>1 = "Faltan constantemente"</p>
							<p>10 = "Nunca faltan"</p>
						</div>
						<div class="ans-row" layout="row">
							<div flex class="ans">1</div>
							<div flex class="ans">2</div>
							<div flex class="ans">3</div>
							<div flex class="ans">4</div>
							<div flex class="ans">5</div>
							<div flex class="ans">6</div>
							<div flex class="ans">7</div>
							<div flex class="ans">8</div>
							<div flex class="ans">9</div>
							<div flex class="ans">10</div>
						</div>
					</div>
				</ng-switch>
			</div>
			
			<form action="/" method="GET" class="comment-form">
				<div layout="row" ng-click="toggleFormEvent()">
					<div flex="10" class="icon-container" hide-sm>
						<i class="icon-comentario-01"></i>
					</div>						
					<textarea flex="90" flex-sm="100" placeholder="Deja un comentario de esta escuela aquí"></textarea>
				</div>
				<div class="extra animated fadeInDown" ng-show="toggleForm">
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
				</div>
			</form>
        </div>
        <div role="tabpanel" id="profile-content" aria-labelledby="tab1" ng-switch-when="1" md-swipe-left="next()" md-swipe-right="previous()" >
		</div>
    </ng-switch>
</div>