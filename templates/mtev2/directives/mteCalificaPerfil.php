<div class="form-success" ng-show="success">
	<p><i class="icon-check-01"></i></p>
	<h3 ng-if="tipo!='biblioteca'">Escuela calificada correctamente.</h3>
	<h3 ng-if="tipo=='biblioteca'">Biblioteca calificada correctamente.</h3>	

</div>
<div class="form-success" ng-show="error">
	<p><i class="icon-tache-01"></i></p>
	<h3>Ocurrio un error, intentalo de nuevo.</h3>
</div>
<form  ng-show="!error && !success"	class="comment-form"	
	ng-submit="califica()"
        ng-init="
		input.tk = '<?=$this->getSimulatedToken($this->simulateP)?>';
		input.cct = '<?=$this->get('id')?>'
	">
	<div layout="row" ng-click="toggleForm = true">
		<div flex="10" class="icon-container" hide-sm>
			<i class="icon-comentario-01"></i>
		</div>						
		<textarea flex="90" flex-sm="100" placeholder="Deja un comentario de esta {{tipo}} aquí" ng-model="input.comentario"></textarea>
	</div>
	<div class="extra animated fadeInDown" ng-show="toggleForm && !success">
		<div class="fields" layout="row" layout-margin layout-fill layout-padding>
			<input type="text"  name="nombre"  flex   ng-model="input.nombre"     flex placeholder="Nombre">
			<input type="email" name="correo"     ng-model="input.correo"    class='hidden'>
			<input type="email" name="email"  flex  ng-model="input.email"    flex placeholder="Correo electrónico">
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
		<div class="sumbit-fields space-between" layout="row" layout-sm="column">
			<div class="captcha" flex="33" flex-sm="100" re-captcha ng-model="captcha"  ></div>
			<div flex="66" flex-sm="100">
				<div layout="row" class="space-between">
					<md-button type="submit" class="md-raised" flex="49">Enviar</md-button>
					<div flex="49" class="check">
						<md-checkbox name="accept" value="1" aria-label="Checkbox 1" ng-model="input.accept">*Quiero que mi nombre se publique junto con mi comentario</md-checkbox>
					</div>
				</div>
				<div class="msg">
					<p>*Tu correo electronico NO aparecerá con tu comentario.</p>
					<p>Si no quieres que tu comentario se publique en el perfil de la escuela, escribenos a:contacto@mejoratuesceual.org</p>
				</div>
			</div>
		</div>
	</div>
	<span ng-init="input.last_name='<?=$this->simulateP?>'"></span>
</form>
