<!DOCTYPE html>
<html lang="es">
 <head>
 	<script  src="/templates/mtev2/js/modernizr.js"></script>
	<meta charset="utf-8"/>
	<base href="/">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="<?=$this->config->http_address?>/templates/<?=$this->config->theme?>/img/favicon.ico" />
	<?php
		$css_scripts = array(
			"importer.css",
			"perfect-scrollbar.min.css",
			"fontello.css",
			"fontello-ie7.css",
			"footable.core.min.css",
			"leaflet.css",
		);
		$js_scripts = array(
			"jquery-1.11.1.min.js",
			'school-charts.js',
			'imagesloaded.pkgd.min.js',
			'bower_components/firebase/firebase.js',
			'bower_components/angular/angular.min.js',
			'bower_components/angular-animate/angular-animate.min.js',
			'bower_components/angular-aria/angular-aria.min.js',
			'bower_components/hammerjs/hammer.min.js',
			'bower_components/angular-material/angular-material.min.js',
			'bower_components/angular-cookies/angular-cookies.min.js',
			'bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js',
			'bower_components/imagesloaded/imagesloaded.pkgd.min.js',
			'bower_components/masonry/dist/masonry.pkgd.min.js',
			'bower_components/angular-masonry/angular-masonry.js',
			'bower_components/angular-masonry/angular-masonry.js',
			'bower_components/angular-re-captcha/angular-re-captcha.js',
			'bower_components/ngSmoothScroll/angular-smooth-scroll.min.js',
			'perfect-scrollbar.min.js',
			'footable.js',
			'perfect-scrollbar.with-mousewheel.min.js',
			'angular-perfect-scrollbar.js',
			'charts.js',
			'leaflet.js',
			'angular-leaflet-directive.min.js',
			'app.js',
			'controllers/controller.js',
			'controllers/conoceCTL.js',
			'controllers/comparaCTL.js',
			'controllers/escuelaCTL.js',
			'controllers/programasCTL.js',
			'controllers/programaCTL.js',
			'controllers/fileCTL.js',
			'services/userInfo.js',
			'services/templateData.js',
			'directives/mteNgSearch.js',
			'directives/mteTextSearch.js',
			'directives/comparaSidebar.js',
			'directives/mteSuscribe.js',
			'directives/mteCalifica.js',
			'directives/mteCalificaPreguntas.js',
		);
		if($this->location == 'escuelas'){
			//$js_scripts[] = 'school-charts.js'; // si no hay cambios en el js no renderizara 
			//correctamente el min.
			echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
			echo '<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.1/leaflet.css">';
		}
		if($this->draw_charts){
			//$js_scripts[] = 'entidad-charts.js';
			echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';
		}
		if($this->draw_map){
			echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlzbyX3J7GwOXdoRwMDfYVbqxNG1D9Jy0&sensor=true"></script>';
			array_push($js_scripts, 'leaflet-googlemaps.js');			
			//$js_scripts[] = 'infobox_packed.js';
			//$js_scripts[] = 'map.js';
		}
		if($this->angular){
			//echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.3/angular.min.js"></script>';
			$js_scripts[] = 'censo2014Archivos.js';
			//$js_scripts[] = 'angularApp.js';
		}
		if(isset($this->config->front_test) && $this->config->front_test){
			$mocha = array(
				"bower_components/chai/chai.js",
				"bower_components/mocha/mocha.js",
				"test/setup.js",
				"test/perfil.js",
				"test/run.js"
			);
			$js_scripts = array_merge($js_scripts,$mocha);
		}

		//var_dump($js_scripts);
		$cssmin = new mxnphp_min($this->config,$css_scripts,"css","css-min-mte");
		$jsmin = new mxnphp_min($this->config,$js_scripts,"js","js-min-mte");
		$cssmin->tag('css');
		//$jsmin->tag('js'); js abajo.
		if(isset($this->meta_description)) echo "<meta name='description' content='{$this->meta_description}' />";
	?>
    <!-- Viewport mobile tag for sensible mobile support -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?=$this->page_title;?></title>

	<meta property='og:image:type' content='image/png'>
	<meta property='og:image' content='http://www.mejoratuescuela.org/templates/mtev1/img/logo200_200.jpg' />	
	<meta property='og:description' content='MejoraTuEscuela.org es una plataforma que busca promover la participación ciudadana para transformar la educación en México' />
	
<?php
$canonical = $this->config->http_address.(isset($_GET['controler'])?$_GET['controler']:'').(isset($_GET['action'])?"/".$_GET['action']:'').(isset($_GET['id'])?"/".$_GET['id']:'');					
$e404 = $this->get('action') == 'e404' ? 'e404' : '';
$this->is404 = isset($this->is404)?$this->is404:false;
?>
	<meta property='og:title' content='Mejora tu escuela'>
	<meta property='og:url' content='<?=$canonical?>'>
	<link rel="canonical" href="<?=$canonical?>" />
 </head>
 <body ng-app="mejoratuescuela" ng-cloak>
	<?php 
	if(isset($this->config->front_test) && $this->config->front_test){
		echo '<div id="mocha"></div>';
	}?>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=1496831027206997&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
 	<?php
 		$customClass = '';
 		if($this->is404) $customClass = 'e404';
 		elseif($this->get('controler') == 'datos-abiertos'){
 			$customClass = 'mtev1-background';
 		} 
 	?>

 	<div id="wrap"><div id="main" class="clearfix <?php echo $customClass;?>"><div id="topBackRepeat"> 		
		<div id='header'>
			<?php 
			$this->include_template('header','global'); 
			if(!$this->is404 && !$this->hide_header){
				$this->include_template('header',$this->header_folder); 
			}
			?>
		</div>
		<div id='content'>
			<?php $this->include_template($this->template,$this->location);?>
		</div>
	</div></div></div>	
	<?php 
		if($this->is404){
			$this->include_template('footer-e404','home'); 
		}else{
			$this->include_template('footer','global'); 
		}
	?>
	<?php 
	$jsmin->tag('js'); 

	?>

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
 </body>
 </html>
