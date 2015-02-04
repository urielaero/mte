<form   class="comment-form" 
	ng-submit="califica(true)"
        ng-init="
		input.tk = '<?=$this->getSimulatedToken($this->simulateP)?>';
		input.cct = '<?=$this->get('id')?>'
	">
	<div ng-show="success" flex="100" class="icon-container form-success">
		<i class="icon-check-01"></i>
		<h3>Comentario enviado al equipo de MTE</h3>
	</div>
	<div ng-show="error" flex="100" class="icon-container form-success">
		<h3>Ocurrio un error, intentalo de nuevo.</h3>
	</div>
	<div layout="row" ng-click="toggleForm = true" ng-show="!success">
		<div flex="10" class="icon-container" hide-sm>
			<i class="icon-comentario-01"></i>
		</div>						
		<textarea flex="90" flex-sm="100" placeholder="¿Quieres dejar un comentario?" ng-model="input.comentario"></textarea>
	</div>
	<div class="extra animated fadeInDown" ng-show="toggleForm && !success">
		<div class="fields" layout="row" layout-margin layout-fill layout-padding>
			<input type="text"  name="nombre"    ng-model="input.nombre"     flex placeholder="Nombre">
			<input type="email" name="correo"    ng-model="input.correo"    class='hidden'>
			<input type="email" name="email"    ng-model="input.email"    flex placeholder="Correo electrónico">
			<input type="text"  name="e_mail"    ng-model="input.e_mail"     class='hidden'/>
			<input type="text"  name="mail"      ng-model="input.mail"       class='hidden'/>
			<input type="text"  name="correo"    ng-model="input.correo"     class='hidden'/>
			<select flex name='ocupacion' ng-model="input.ocupacion">
				<option value=''>¿Quién eres?</option>
				<option value='alumno'>Alumno</option>
				<option value='exalumno'>Exalumno</option>
				<option value='padredefamilia'>Padre de familia</option>
				<option value='maestro'>Maestro</option>
				<option value='director'>Director</option>
				<option value='ciudadano'>Ciudadano</option>
			</select>
		</div>
		<div flex="100" class="check">
			<md-checkbox name="accept" ng-model="input.accept" value="1" aria-label="Checkbox 1">*Quiero que mi nombre se publique junto con mi comentario</md-checkbox>
		</div>
	</div>
	<span ng-init="input.last_name='<?=$this->simulateP?>'"></span>
	<div layout="row" class="" layout-margin layout-fill layout-padding layout-align="center">
		<md-button class="success" ng-show="!toggleForm && !success" type="submit" flex="100" >Enviar calificación</md-button>
		<md-button class="success" ng-show="toggleForm && !success" type="submit" flex="100" >Enviar calificación y comentario</md-button>
	
	</div>
</form>
<!--
				<div class="msg">
					<p>*Tu correo electronico NO aparecerá con tu comentario.</p>
					<p>Si no quieres que tu comentario se publique en el perfil de la escuela, escribenos a:contacto@mejoratuesceual.org</p>
-->
				</div>
