<div class='container e404 medium-width escuelas'>
	<h1>!Oops, error!</h1>
	<p>No encontramos la página que buscaste</p>
	<img src="/templates/mtev2/img/error404/pizarron.png" alt="" class="e404-image">
	<?php if($this->suggestion){?>
		<h2><i class='icon-buscar-01'></i>¿Estabas buscando esta escuela?</h2>	
		<a href="/escuelas/index/<?=$this->escuela->cct?>" class="button-bordered suggestion">
			<p><strong><?=$this->capitalize($this->escuela->nombre)?></strong></p>
			<p><?=$this->escuela->entidad->nombre?></p>
			<p><?=$this->capitalize($this->escuela->turno->nombre)?></p>
		</a>
	<?php } ?>
	<a href="/" class="button-bordered"><strong>mejoratuescuela.org</strong></a>
</div>

