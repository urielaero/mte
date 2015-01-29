<h1 class="green-title">Califica tu escuela seleccionando para cada campo una calificación del <strong>1-10</strong>.<br/>Estas calificaciones se promedian para generar la calificación general de tu escuela</h1>

<?php
$icons = array(
            "icon-programaapoyo-01",
            "icon-check-01",
            "icon-familia-01",
            "icon-escuela-01",
            "icon-desk-01",
            "icon-buscar-01",
        );


if($this->preguntas){
    foreach($this->preguntas as $i=>$pregunta){ 
        if(!($i%2))
            echo '<div class="questions-box space-between" layout="row" layout-sm="column">'
        ?>
	<div class="question" flex-sm="100" >
		<div class="question-content">
    		<div class="question-title q<?=intval(($i+2)/2)?>" layout="row">
    			<div class="icon-container" flex="20">
					<div  class="icon-wrapper vertical-align-center horizontal-align-center">
						<i class="<?=isset($icons[$i])?$icons[$i]:$icons[0]?>"></i>
					</div>		        				
    			</div>
    			<h3 flex="80"><?=$pregunta->titulo?></h3>
    		</div>
        	<div class="text">
				<p><?=$pregunta->pregunta?></p>
				<p>1 = "<?=$pregunta->descripcion_valor_minimo?>"</p>
				<p>10 = "<?=$pregunta->descripcion_valor_maximo?>"</p>
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
	</div>

    <?php 
        if($i%2==1)
            echo "</div>";
    }
}
?>
<div class="result" layout="row">
	<div flex="70" class="desc">En promedio, calificas a tu escuela con:</div>
	<div flex="30" class="number">8</div>
</div>

<form action="/" method="GET" class="comment-form">
	<div layout="row" ng-click="toggleFormEvent()">
		<div flex="10" class="icon-container" hide-sm>
			<i class="icon-comentario-01"></i>
		</div>						
		<textarea flex="90" flex-sm="100" placeholder="Deja un comentario de esta escuela aquí" ng-model="comment[selectedIndex]"></textarea>
	</div>
	<div class="extra animated fadeInDown" ng-show="toggleForm">
		<div class="fields" layout="row" layout-margin layout-fill layout-padding>
			<input type="text" name="nombre" flex placeholder="Nombre">
			<input type="email" name="correo" flex placeholder="Correo electrónico">
			<select flex>
				<option value="">¿Quién eres?</option>
			</select>
		</div>
		<div class="sumbit-fields space-between" layout="row" layout-sm="column">
			<div class="captcha" flex="33" flex-sm="100"></div>
			<div flex="66" flex-sm="100">
				<div layout="row" class="space-between">
					<md-button ng-show="comment[selectedIndex]" type="submit" class="md-raised" flex="49">Enviar</md-button>
					<md-button ng-show="!comment[selectedIndex]" type="submit" class="md-raised" flex="49">Enviar calificación</md-button>
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
