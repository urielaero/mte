<?php 
$url_logo = $this->config->http_address."templates/".$this->config->theme."/img/logo_mejora.png";
$url = $this->config->http_address.$this->location;
$url = $url."/index/".$this->get('id');
$title = "El perfil de ".$this->capitalize($this->escuela->nombre);
$description = $title;
$urlFb = $url."#facebook";
$urlTwitter = $url."#twitter";
$urlMail = $url."#mail";
?>
<script type='text/javascript'>
    window.escuela = <?= json_encode($this->escuelaSummary) ?>;
</script>
<script type="text/ng-template" id="mteCalifica.html">
	<?php $this->include_template('mteCalificaPerfil','directives'); ?>
</script>
<script type="text/ng-template" id="mteNgSearch.html">
	<?php $this->include_template('mteNgSearch','directives'); ?>
</script>
<script type="text/ng-template" id="mteTextSearch.html">
	<?php $this->include_template('mteTextSearch','directives'); ?>
</script>

<div class="container profile profile-escuela profile-biblioteca" ng-controller="escuelaCTL">
	<div class="breadcrumb perfect-breadcrumb">
		<a href="/" class="start"><i class="icon-mejora"></i></a>
		<?php foreach($this->breadcrumb as $url => $breadcrumb){ ?>
			<a href="<?=$url ?>"><?=$breadcrumb ?></a>
		<?php } ?>
	</div>
	<div class="menu-top">
		<div layout="row" layout-sm="column" class="menu-row perfect-menu-row">
			<div class="profile-title">
				<div class="title-container" layout="row">
					<div flex="25" class="icon-container" hide-sm>
						<div class="icon-wrapper vertical-align-center horizontal-align-center">
							<i class="icon-escuela-01"></i>
						</div>
					</div>
					<?php 
					?>
					<div flex="75" flex-sm="100">
						<h1><?=$this->capitalize($this->escuela->nombre)?></h1>
					</div>
				</div>			
			</div>
		</div>
	</div>

	<div role="tabpanel" id="profile-content">
		<div class="space-between" layout="row" layout-sm="column">
			<div class="main-info" flex="73" flex-sm="100">
				<div layout="row" layout-sm="column">
					<leaflet id="map" center="center" markers="markers"  flex="50" flex-sm="100"
		            ng-init='loadMap(<?=json_encode($this->escuelas_digest)?>,"<?=$this->escuela->cct?>")'></leaflet>	
					<div class="info" flex="50" flex-sm="100">
						<div class="califica" layout="row">
							<div flex="35" class="icon-container">
								<div class="icon-wrapper vertical-align-center horizontal-align-center">
									<i class="icon-califica2-01"></i>
								</div>
							</div>
							<div flex="65">
								<h4>Califica tu biblioteca</h4>
							</div>
							<a href="califica_tu_escuela/califica/<?=$this->escuela->cct?>" class="full-size-link"></a>
						</div>
						<div class="block">
							<ul>
								<li>
									Dirección: <?=$this->capitalize($this->escuela->domicilio)?>, 
									<?=$this->capitalize($this->escuela->municipio->nombre)?>, 
									<?=$this->capitalize($this->escuela->localidad->nombre)?>,
									<?=$this->capitalize($this->escuela->entidad->nombre)?> 
								</li>
								<li>Clave: <?=$this->escuela->cct?></li>
								<li>Télefonos: <?=$this->escuela->telefono?></li>
								<?php if(isset($this->escuela->correoelectronico) && $this->escuela->correoelectronico){?>
									<li>Correo electrónico:<?=$this->escuela->correoelectronico?> </li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div flex="25" class="semaphore" flex-sm="100">
				<div class="section-image">
					<img src="/templates/mtev2/img/biblio.png" alt="Biblioteca">			
				</div>
			</div>	
		</div>			
		<div class="additional-info space-between" layout="row" layout-sm="column">
			<div class="data" flex="73" flex-sm="100">
				<div mte-califica tipo="'biblioteca'"></div>
		        <div  class="comentarios tables-box" id="comentarios">
					<?php
						$cp = 0;
						$pt = 0;
						if($this->escuela->calificaciones){
							foreach($this->escuela->calificaciones as $calificacion){
								if(isset($calificacion->calificacion)){
									$cp++;
									$pt += $calificacion->calificacion;
								}
							}
							$pro = $pt/$cp;
							$pro = number_format($pro,2);
						}else{
							$pro = "n/a";
						}
					?>

					<h2 layout="row" layout-sm="column">
						<div flex="50" flex-sm="100">Comentarios</div>
						<div flex="50" flex-sm="100">
							<div layout="row" class="total">
								<div flex="20" class="icon-box"><i class="icon-desk-01"></i></div>
								<div flex="60">Total de personas que evaluaron esta biblioteca</div>
								<div flex="20"><strong><?=isset($this->escuela->calificaciones)?count($this->escuela->calificaciones):0 ?></strong></div>
						</div>
					</h2>
					<div class="table-top" layout="row">
						<div flex="10" flex-sm="15" class="i-cont"><i class="icon-estrella-01"></i></div>
						<div flex="90" flex-sm="85"><p>Calificación global de la biblioteca según usuarios</p></div>
					</div>
					<table>
						<tr><td>Calificación global</td><td><?=$pro?></td></tr>
					</table>
					<div class="table-top" layout="row">
						<div flex="10" flex-sm="15" class="i-cont"><i class="icon-pregunta-01"></i></div>
						<div flex="90" flex-sm="85"><p>Calificación promedio por pregunta</p></div>
					</div>
					<table>
					<?php
					if($this->preguntas){
						foreach($this->preguntas as $pregunta){
							echo "<tr>
								<td>{$pregunta->titulo}</td>
								<td>".(isset($pregunta->promedio) ? $pregunta->promedio:"n/a")."</td>
							</tr>";
						}
					}
					?>
					</table>
					<div class="table-top" layout="row">
						<div flex="10" flex-sm="15" class="i-cont"><i class="icon-comentario2-01"></i></div>
						<div flex="90" flex-sm="85"><p>Calificación promedio por pregunta</p></div>
					</div>

					<?php if(isset($this->escuela->calificaciones)){?>
					<ul class="comments-list">
						<?php 
						foreach($this->escuela->calificaciones as $calificacion){
							if(isset($calificacion->activo) && $calificacion->activo){
								$coment = preg_replace('/\v+|\\\[rn]/','<br/>',$calificacion->comentario);
		                			        $coment = stripslashes($coment);
								$text_calificacion = isset($calificacion->calificacion)?'<span>Calificación <br /> otorgada</span>':'';
								$ocupacion = $calificacion->ocupacion =='padredefamilia' || $calificacion->ocupacion == 'Padre de familia' ? 'Padre de familia':($this->capitalize($calificacion->ocupacion));
								$cali = $calificacion->calificacion;
								$cali = $cali > 10?$cali/10:$cali;//error cuendo en la db se calificaba de a 100
								$nombreCalificacion  = ($calificacion->acepta_nombre == 1) ? $calificacion->nombre : ''; 
								date_default_timezone_set('America/Mexico_City');
								$time = date("d M Y",strtotime($calificacion->timestamp));
								echo <<<EOD
						<li>
							<p><strong class="green">Calificación: {$cali} | </strong>{$nombreCalificacion} ({$ocupacion})</p>
							<p>{$time}</p>
							<p>{$calificacion->comentario}</p>
						</li>
EOD;
								}
							}
						
						?>
					</ul>
					<?php } ?>
				</div>
			</div>
			<div flex="25" flex-sm="100" class="semaphore">
				<div class="share_options">
					<div class="options space-between" layout="row" layout-md="column">
						<div flex="49" class="option">
								<p><i class="icon-print-01"></i></p>
								<p ng-click="print();">Imprimir</p>
						</div>
						<div flex="49" class="option" ng-click="show_share = !show_share">
							<span>
								<p><i class="icon-share-01"></i></p>
								<p>Compartir</p>
								</span>
						</div>
					</div>
					<div  class="share_show" layout="row" layout-md="column" ng-show="show_share">
						<div flex="30" class="share_fb">
							<a href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?=$urlFb?>&p[images][0]=<?=$url_logo?>&p[title]=<?=$title?>&p[summary]=<?=$description?>" target='_blank'>
								<i class="icon-fb-01"></i>
							</a>
					
						</div>
						<div flex="30" class="share_twitter"> 
							<a href="http://twitter.com/home?status=<?=$title." ".$urlTwitter," por @mejoratuescuela"?> " target='_blank' >
								<i class="icon-twitter-01-01"></i>
						
							</a>		
						</div>
						<div flex="30" class="share_email">
							<a href="mailto:?subject=<?=$title?>&amp;body=<?=$description.": ".$urlMail?>" target='_blank'>
								<i class="icon-mail-01"></i>
						
							</a>		
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
