<!DOCTYPE html>
 <html lang="es">
 <head>
	<meta charset="utf-8"/>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<?php
		$css_scripts = array(
			"reset.css",
			"main.css",
			"jquery-ui.css",
			"jquery.jscrollpane.css"
		);
		$js_scripts = array(
			"jquery.js",
			"jquery-ui.js",
			'jquery.mousewheel.js',
			'jquery.jscrollpane.min.js',
			'jquery.customSelect.min.js',
			'jquery.validate.min.js',
			'jquery.cookie.js',
			"interactions.js"
		);
		if($this->location == 'escuelas'){
			$js_scripts[] = 'school-charts.js';
			echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		if($this->location == 'mapa' || $this->location == 'escuelas'){
			echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlzbyX3J7GwOXdoRwMDfYVbqxNG1D9Jy0&sensor=true"></script>';
			$js_scripts[] = 'map.js';
		}
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-mte");
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte");
		$cssmin->tag('css');
		$jsmin->tag('js');
	?>
	<title><?=$this->page_title;?></title>
 </head>
 <body>
 	<div id="wrap"><div id="main" class="clearfix"><div id="topBackRepeat">
		<div id='header'>
			<?php 
			$this->include_template('header','global'); 
			$this->include_template('header',$this->header_folder); 
			?>
		</div>
		<div id='content'><?php $this->include_template($this->template,$this->location);?></div>
	</div></div></div>	
	<div id='footer'><?php $this->include_template('footer','global'); ?></div>	 
 </body>
 </html>