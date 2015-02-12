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
	<div class='container results mteNgSearch'>
		<div class="breadcrumb">
			<a href="#" class="start"><i class="icon-mejora"></i></a>
			<a href="#">Comparador</a>
		</div>
	</div>
	<div class="cont-semaforos-results" mte-ng-search objects='{municipios:municipios,entidades:entidades,localidades:localidades}'></div>
</div>
