<form action='<?=$this->get('action') == 'califica'?'/califica-tu-escuela/califica':'/compara#resultados'?>' method='get' accept-charset='utf-8' class='general-search' id='general-search'>
	<p class='button-frame search-adv'>
		<a href="/compara/">Búsqueda avanzada</a>
	</p>
	<p class='button-frame'>
		<input name='term' id='name-input' type='text' placeholder='Busca tu escuela' value='<?=$this->request('term');?>' />
		<input type='submit' class='integrated' value='' />
		<span class='icon sprites'></span>
		<input type='hidden' name='search' value='true' />
	</p>
	<!--
	<p class='adv-search'><a href='/compara/' >Búsqueda avanzada
		<span class='icon sprites'></span>
	</a></p>
	-->
	<div class='clear'></div>
 </form>
<div class="decorations simple">
	<hr>
	<hr>
	<hr>
	<hr>
	<hr>	
	<?php $this->print_img_tag('/home/palomita.png');
	$this->print_img_tag('/home/birrete_small.png');
	?>
</div>
