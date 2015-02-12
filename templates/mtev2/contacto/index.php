<div class='container contact'>
	<div class="breadcrumb">
		<a class="start start2-2" href="#">
			<i class="icon-escuela-01"></i>
		</a>
		<a href="#">Contacto</a>
	</div>
	<div class="header-form-contactanos" layout="row" layout-sm="column">
		<div class="items-header-contact contactanos-contactanos" flex="20" flex-sm="100">
			<h3 class="h3-contactanos-contacto">¡Contáctanos!</h3>
		</div>
		<div flex="35" flex-sm="100">
			<div layout="row">
				<div flex="15" flex-sm="20" class="icon-container items-header-contact ico-contact mail-contactanos">
					<div class="icon-wrapper vertical-align-center horizontal-align-center">
						<i class="icon-mail-01 telefono-contact"></i>
					</div>
				</div>				
				<div flex="75" class="items-header-contact correo-contactanos">
					<h4 class="h3-contactanos">contacto@mejoratuescuela.org</h4>
				</div>
			</div>
		</div>
		<div flex="35" flex-sm="100">
			<div layout="row">
				<div flex="15" flex-sm="20" class="icon-container items-header-contact ico-contact icotelefono-contactanos">
					<div class="icon-wrapper vertical-align-center horizontal-align-center">
						<i class="icon-telefono-01 telefono-contact"></i>
					</div>
				</div>					
				<div flex="50" class="items-header-contact telefono-contactanos">
					<h5 class="h3-contactanos ">(55)-5985-1017</h5>
				</div>
			</div>
		</div>
	</div>
	<form action='/contacto/enviar/' method='POST' class="form-contacto">
		<?php 	if(isset($this->contact_status) && $this->contact_status)
				echo '<h3 class="msj" >Gracias, tu mensaje se ha enviado</h3>';
			else if(isset($this->contact_status) && !$this->contact_status)
				echo '<h3 class="msj" >Hubo un error, intentalo de nuevo</h3>';
		?>
		<div layout="row" class="space-between">
			<input type="text" class="text-input forms-contactanos" name='nombre' required="" placeholder="Nombre" flex="45">
			<input type="mail" class="mail-input forms-contactanos" name='email' required="" placeholder="Correo electrónico" flex="45">
		</div>
		<textarea placeholder="Mensaje" class=" forms-contactanos" cols="30" name='mensaje' required="" rows="7"></textarea>
		<input class="boton-contactos-enviar" type="submit" value="Enviar" >
		<?php echo $this->get_captcha(); ?>
		<div class="clear"></div>
	</form>
</div>