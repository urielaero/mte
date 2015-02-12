<div class='container about'>
	<div class="breadcrumb">
		<a href="#" class="start"><i class="icon-mejora"></i></a>
		<a href="#">¿Quiénes somos?</a>
	</div>
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="65" flex-sm="100" class="about-content">
			<div class="about-text">
				<p>MejoraTuEscuela.org es una iniciativa ciudadana, independiente y sin fines de lucro.</p>
				<p>Nuestro equipo está integrado por miembros del Instituto Mexicano para la Competitividad A.C. (IMCO) con apoyo de la fundación Omidyar Network.</p>
				<p>A través de esta plataforma queremos promover la participación ciudadana para mejorar la educación en México. Estamos convencidos que la educación en nuestro país sólo mejorará con el compromiso activo de todos los miembros de la comunidad educativa, en particular los padres de familia.</p>
				<p>MejoraTuEscuela.org te invita a buscar y conocer cómo está la escuela de tus hijos, compararla con otras escuelas en tu zona, calificarla y darnos tu opinión sobre las cosas que necesitan mejorar y las que ya se están haciendo bien. Finalmente, te damos herramientas para que te vuelvas un miembro activo y comprometido que gestione cambios positivos y mejoras en tu comunidad educativa.</p>
				<p>MejoraTuEscuela.org es una plataforma de todos y para todos los mexicanos. Te invitamos a que la uses y nos ayudes a difundirla.</p>
				<p class="green"><strong>¡Gracias!</strong></p>
				<div class="logos">
					<?php $this->print_img_tag('quienes_somos/imco_qs.png');
					$this->print_img_tag('quienes_somos/on_qs.png');
					?>
					<div class="clear"></div>			
				</div>
			</div>
			<div class="menu-top">
				<div layout="row" layout-sm="column" class="menu-row">
					<div class="profile-title" flex="55" flex-sm="100">
						<div class="title-container" layout="row">
							<div flex="100" flex-sm="100" class="more-info">
								<h2>Para más información</h2>
							</div>
						</div>			
					</div>
					<div class="tabs" flex="45" flex-sm="100">
					    <md-tabs md-selected="selectedIndex">
					    	<md-tab id="phone-tab" aria-controls="tab1-content">
					    		<i class="icon-telefono-01"></i>
					      	</md-tab>
					      	<md-tab id="mail-tab" aria-controls="tab2-content">
					      		<i class="icon-mail-01"></i>
					      	</md-tab>
					    </md-tabs>				
					</div>
				</div>
			</div>
    		<ng-switch on="selectedIndex" class="tabpanel-container">
        		<div role="tabpanel" class="tab-content phone-content" aria-labelledby="tab1" ng-switch-when="0" md-swipe-left="next()" md-swipe-right="previous()" >
					<p>Comunícate a los teléfonos de <b>IMCO</b></p>
					<p> con el equipo de Mejora tu Escuela al <b>(55)5985-1017 al 19</b>.</p>
				</div>
        		<div role="tabpanel" class="tab-content mail-content" aria-labelledby="tab1" ng-switch-when="1" md-swipe-left="next()" md-swipe-right="previous()" >
					<p>Escríbenos a: <a href="#">contacto@mejoratuescuela.org</a></p>
				</div>
			</ng-switch> 
		</div>
		<?php $this->include_template('sidebar','home');  ?>
	</div>
</div>
