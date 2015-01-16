<div class='container mejora' ng-controller="mejoraCTL">
	<div layout="row" layout-sm="column" class="space-between">
		<div flex="65" flex-sm="100" id="mejora-content">
			<div class="menu-top">
				<div class="tabs">
				    <md-tabs md-selected="selectedIndex">
				    	<md-tab id="tool-tab" aria-controls="tab1-content">
				    		<i class="icon-matutino"></i>
				    		<p><strong>Herramientas de mejora</strong></p>
				      	</md-tab>
				      	<md-tab id="programs-tab" aria-controls="tab2-content">
				      		<i class="icon-mail-01"></i>
				      		<p><strong>Programas de apoyo</strong></p>
				      	</md-tab>
				    </md-tabs>				
				</div>
			</div>
    		<ng-switch on="selectedIndex" class="tabpanel-container">
        		<div role="tabpanel" class="tab-content tools-content" aria-labelledby="tab1" ng-switch-when="0" md-swipe-left="next()" md-swipe-right="previous()" >
					<div class="space-between" id="blog-posts" layout="row">
						<div class="post">
							<div class="post-image">
								<a href="#"><img src="/templates/mtev2/img/blogpost1.png" alt=""></a>
								<div class="clear"></div>
							</div>
							<div class="description">
								<h3><a href="#">Consejos de Participación y Asociación de Padres, ¿son lo mismo?</a></h3>
							</div>
							<div layout="row" class="more">
								<a href="#" flex="50">Leer más</a>
								<a href="#" flex="50"><i class="icon-mail-01"></i></a>
							</div>
						</div>
						<div class="post">
							<div class="post-image">
								<a href="#"><img src="/templates/mtev2/img/blogpost2.jpg" alt=""></a>
								<div class="clear"></div>
							</div>
							<div class="description">
								<h3><a href="#">Día de muertos en México</a></h3>
							</div>
							<div layout="row" class="more">
								<a href="#" flex="50">Leer más</a>
								<a href="#" flex="50"><i class="icon-mail-01"></i></a>
							</div>
						</div>
						<a href="#" class="button-bordered">Consulta más información</a>
					</div>
				</div>
        		<div role="tabpanel" class="tab-content programs-content" aria-labelledby="tab1" ng-switch-when="1" md-swipe-left="next()" md-swipe-right="previous()" >
					<p>Para más información, escríbenos a: <a href="#">contacto@mejoratuescuela.org</a></p>
				</div>
			</ng-switch> 
		</div>
		<?php $this->include_template('sidebar','mejora');  ?>
	</div>
</div>
