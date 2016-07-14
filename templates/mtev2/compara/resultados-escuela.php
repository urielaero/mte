<script type='text/javascript'>
    window.entidades = <?= json_encode($this->entidades)?>;
    window.municipios = <?= json_encode($this->municipios)?>;
    window.localidades = <?= json_encode($this->localidades)?>;
</script>
<script type="text/ng-template" id="mteNgSearch.html">
	<?php $this->include_template('mteNgSearch','directives'); ?>
</script>
<script type="text/ng-template" id="mteTextSearch.html">
	<?php $this->include_template('mteTextSearch','directives'); ?>
</script>
<div ng-controller='conoceCTL'>
	<!-- Compara Leaderboard 1 - 728x90 -->
	<div class="adsbygoogle-content conoce">
		<ins class="adsbygoogle"
			style="display:inline-block;width:728px;height:90px"
			data-ad-client="ca-pub-5016039473129201"
			<?php if ( !isset($this->config->ad_mode_test) || $this->config->ad_mode_test ) {?>
				data-ad-test="on"
			<?php } ?>
			data-ad-slot="2506321771"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>

	<div class='container results mteNgSearch'>
		<div class="breadcrumb">
			<a href="#" class="start"><i class="icon-mejora"></i></a>
			<a href="/compara">Comparador</a>
		</div>
	</div>
	<?php if($this->get('search')){
		$vars = array('term','control','nivel','entidad','municipio','localidad','search');
		$params = array();
		foreach($vars as $v){
			if(($tmp = $this->get($v)))
				$params[$v] = $tmp;
		}
		?>
		
		<div class="cont-semaforos-results" mte-ng-search objects='{municipios:municipios,entidades:entidades,localidades:localidades}' params='<?=json_encode($params)?>'></div>
		
	<?php }else{ ?>
		<div class="cont-semaforos-results" mte-ng-search objects='{municipios:municipios,entidades:entidades,localidades:localidades}' urls="1"></div>
	<?php } ?>
</div>
