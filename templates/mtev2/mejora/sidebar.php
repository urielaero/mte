		<div flex="30" flex-sm="100" id="sidebar" class="mejora-sidebar">
			<form class="search-form" layout="row" layout-sm="column">
				<input type="text" placeholder="Búsca una infografia" flex="80">
				<input type="submit" value="" flex="20">
			</form>
			<div class="email-box">
				<h4><strong><i class="icon-mail-01"></i> Mantente informado</strong></h4>
				<form action="#">
					<input type="text">
					<input type="submit" value="Suscríbete" class="button-bordered">
					<md-checkbox aria-label="Checkbox 1"></md-checkbox><a href="#">Aviso de privacidad</a>
				</form>
			</div>
			<div class="box box-orange">
				<a href="#" class="full-size-link"></a>
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-blog-01"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>Mejora tu entorno</p></div>
				</div>
			</div>
			<div class="box box-green">
				<a href="#" class="full-size-link"></a>
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-mejora"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>Herramientas de mejora</p></div>
				</div>
			</div>
			<div class="box box-purple">
				<a href="#" class="full-size-link"></a>				
				<div layout="row">
					<div flex="25" class="icon-container">
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-programaapoyo-01"></i>
						</div>
					</div>	
					<div flex="75" class="text-container"><p>Mejora tu aprendizaje</p></div>
				</div>
			</div>
			<div class="box box-form">
				<p class="icon-p"><i class="icon-comentario-01"></i></p>
				<p>Si te interesa algún otro tema que no aparezca en nuestra sección</p>
				<div class="write-us">
					<p class="trigger" ng-click="toggleFormEvent()">Escríbenos</p>
					<form action="#" ng-show="toggleForm">
						<input type="text" placeholder="Mensaje">
						<input type="email" placeholder="Tu correo">
						<input type="submit" class="button-bordered" value="Envia al equipo de MTE">
					</form>
				</div>
			</div>
		</div>
