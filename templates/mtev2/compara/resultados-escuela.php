<script type='text/javascript'>
    window.entidades = <?= json_encode($this->entidades)?>;
    window.municipios = <?= json_encode($this->municipios)?>;
    window.localidades = <?= json_encode($this->localidades)?>;
</script>
<script type="text/ng-template" id="mteNgSearch.html">
	<?php $this->include_template('mteNgSearch','directives'); ?>
</script>
<div ng-controller='conoceCTL'>
	<div class='container results mteNgSearch'>
		<div class="breadcrumb">
			<a href="#" class="start"><i class="icon-mejora"></i></a>
			<a href="#">Conoce</a>
		</div>
	</div>
	<div mte-ng-search objects='{municipios:municipios,entidades:entidades,localidades:localidades}'></div>
</div>