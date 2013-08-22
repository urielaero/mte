<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<?php
		$css_scripts = array("widget2.css");		
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min--mte-widget-2");
		$cssmin->tag('css');
	?>
	<title><?=$this->page_title;?></title>
 </head>
 <body>
 	<div id='container'>
 		<div class='head'>
	 		<a href='http://www.mejoratuescuela.org' class='logo' title='Mejora tu Escuela'><span><?php $this->print_img_tag('/widget/logomte.png','Meoratuescuela.org') ?></span></a>
	 		<h1>Ayuda a transformar tu colegio</h1>
 		</div>
 		<p class='text'>Consulta los resultados de Enlace de las escuelas públicas y privadas del País y aprende cómo puedes ayudar a mejorar la educación de tu centro escolar.</p>
 		<form action='http://www.mejoratuescuela.org/compara/#resultados' method='get' accept-charset='utf-8' target="_blank">
 			<p>
 				<input type='text' placeholder='Buscar Escuela' name='term' />
 				<input type='hidden' name='search' value='true' class='submit'/>
 				<input type='submit' value='' class='submit'/>
 			</p>
 			<div class='clear'></div>
 		</form>
 	</div>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-4404650-7', 'mejoratuescuela.org');
ga('send', 'pageview');
</script>
 </body>
 </html>
