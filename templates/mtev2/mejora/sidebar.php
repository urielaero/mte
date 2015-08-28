<script type="text/ng-template" id="mteSuscribe.html">
	<?php $this->include_template('mteSuscribe','directives'); ?>
</script>
		<div flex="30" flex-sm="100" id="sidebar" class="mejora-sidebar">

			<form action="http://blog.mejoratuescuela.org/" method="GET" accept-charset="utf-8"  class="search-form" layout="row" >
				<input type="text" name="s" autocomplete="off" placeholder="Busca una infografía" flex="80">
				<input type="submit" value="" flex="20">
			</form>
			<div mte-suscribe></div>

			<div class="box box-orange">
				<a href="/mejora/programas#?tema=Infraestructura educativa" class="full-size-link"></a>
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
				<a href="/mejora/programas" class="full-size-link"></a>
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
				<a href="/mejora/programas#?tema=Desempeño académico y liderazgo." class="full-size-link"></a>				
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
					<p class="trigger ct-link">
						<a href="/contacto">Escríbenos</a>
					</p>
				</div>
			</div>
		</div>
