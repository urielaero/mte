<div class='perfil container'>
	<div class='head'>
		<div class='ranking'>
			<h1>46</h1>
			<p>Posición <br/>Nivel Nacional</p>
		</div>
		<div class='nivel <?=$this->config->semaforos[$this->escuela->semaforo]?>'><div class='bubble'></div><?=$this->config->semaforos[$this->escuela->semaforo]?></div>
		<h1 class='main-name'><?=$this->capitalize($this->escuela->nombre)?></h1>
		<div class='semaforo'>
			<h2>Semáforo Educativo</h2>
			<h3 class='nivel reprobado'>Reprobado</h3>
			<h3 class='nivel elemental'>Elemental</h3>
			<h3 class='nivel bien'>Bien</h3>
			<h3 class='nivel excelente'>Excelente</h3>
		</div>
	</div>
	
	<div class='info'>
		<h1><?=$this->capitalize($this->escuela->nombre)?></h1>
		<h2><?=$this->capitalize($this->escuela->nivel->nombre)?> | <?=$this->capitalize($this->escuela->turno->nombre)?> | <?=$this->capitalize($this->escuela->control->nombre)?></h2>
		<hr />
		<p class='icon dom'>
			<?=$this->capitalize($this->escuela->domicilio)?><br/>
			<?=$this->capitalize($this->escuela->localidad->nombre)?>, <?=$this->capitalize($this->escuela->entidad->nombre)?> <br />
			<?=$this->capitalize($this->escuela->municipio->nombre)?> <br/>
			<?=$this->escuela->cct?>
		</p>
		<p class='icon fon'><?=$this->escuela->telefono?></p>
		<p class='icon email'><?=$this->escuela->correoelectronico?></p>
		<p class='website'><?=$this->escuela->paginaweb?></p>


			<!--<p>Clave SEP: </p>
			<p>Servicio: <?=$this->capitalize($this->escuela->servicio->nombre)?></p>
			<p>Subnivel: <?=$this->capitalize($this->escuela->subnivel->nombre)?></p>
			<p>Subcontrol: <?=$this->capitalize($this->escuela->subcontrol->nombre)?></p>
			<p>Sostenimiento: <?=$this->capitalize($this->escuela->sostenimiento->nombre)?></p>
			<p>Tipo:<?=$this->capitalize($this->escuela->tipo->nombre)?></p>
			<div class='contact'>
				<p>Telefono: </p>
				<p>Correo Electronico: </p>
				<p>Pagina Web: </p>
			</div> -->
	</div>

	<div id='map-data' class='hidden'><?= json_encode($this->escuelas_digest)?></div>
	<div id='mapa' class='map'></div>
	<div class='clear'></div>
	<ul class='tabs'>
		<li><a href='#' class='long' >Asociaciones de Padres de Familia</a></li>
		<li><a href='#' >Resultados Educativos</a></li>
		<li><a href='#' >Más Informacion</a></li>
		<li><a href='#' >Reportes Ciudadanos</a></li>
		<li class='on'><a href='#' class='long'>Comentarios con Calificacion</a></li>
	</ul>
	<div class='tab-container'>
		<div class='tab jscrollpane'>
			<a name='calificaciones'></a>
			<?php
			if($this->escuela->calificaciones){
				foreach($this->escuela->calificaciones as $calificacion){
					echo <<<EOD
					<div class='comment'>
						<p class='rating'>{$calificacion->calificacion}%<span class='likes'>{$calificacion->likes}</span><a href='/escuelas/like_calificacion/{$calificacion->id}/'></a></p>
						<h2>{$calificacion->nombre}</h2>
						<p>{$calificacion->comentario}</p>
					</div>
EOD;
				}
			}else{

			}
			?>
		</div>
	</div>	
	<div class='gray-box'>
		<form method='post' action='/escuelas/calificar/' accept-charstet='utf-8' class='validate-form'>
			<p>En ningún momento haremos público tu correo electrónico con tu comentario</p>
			<div class='column'>
				<p>
					<input type='text' placeholder='Tu nombre' name='nombre' class='required' />
					<select class='custom-select' name='ocupacion' >
						<option value=''>Ocupación</option>
						<option value='ocupacion 1'>Ocupación 1</option>
						<option value='ocupacion 2'>Ocupación 2</option>
						<option value='ocupacion 3'>Ocupación 3</option>
						<option value='ocupacion 4'>Ocupación 4</option>
					</select>
					<textarea placeholder='Comentario' name='comentario' class='required'></textarea>
				</p>
			</div>
			<div class='column'>
				<p>
					<input type='text' class='required email' placeholder='Correo eléctronico' id='email' name='email' />
				</p>
				<p class='rater'>
					Califica esta escuela
					<span class='ranker' id='rank-bar'><span class='bar'></span></span>
					<span class='label' id='rank-label'>6.8%</span>
					<input type='hidden' id='rank-value' name='calificacion' value='' class='required'/>
					<input type='hidden' id='cct' name='cct' value='<?=$this->escuela->cct?>' />
				</p>
			</div>
			<div class='clear'></div>
			<p><input type='submit' value='Califica tu escuela' /></p>
		</form>
	</div>
	<div class='gray-box'>
		<form method='post' action='/escuelas/reportar/' accept-charstet='utf-8' class='validate-form reporte-form'>
			<h2>Tu reporte será completamente anónimo</h2>
			<p>En ningún momento haremos público tu correo electrónico con tu comentario</p>
		</form>
	</div>	
</div>