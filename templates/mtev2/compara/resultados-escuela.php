<script type='text/javascript'>
    window.entidades = <?= json_encode($this->entidades)?>;
    window.municipios = <?= json_encode($this->municipios)?>;
    window.localidades = <?= json_encode($this->localidades)?>;
</script>
<div ng-controller='conoceCTL'>
	<script type="text/ng-template" id="mteNgSearch.html">
		<?php $this->include_template('mteNgSearch','directives'); ?>
	</script>

	<div mte-ng-search objects='{municipios:municipios,entidades:entidades,localidades:localidades}'></div>
</div>