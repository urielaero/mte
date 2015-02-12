<script type="text/ng-template" id="mteNgSearch.html">
	<?php $this->include_template('mteNgSearch','directives'); ?>
</script>
<script type="text/ng-template" id="mteCalificaPreguntas.html">
	<?php $this->include_template('mteCalificaPreguntas','directives'); ?>
</script>
<script type="text/ng-template" id="mteTextSearch.html">
</script>
<script type="text/ng-template" id="mteCalifica.html">
	<?php $this->include_template('mteCalifica','directives'); ?>
</script>
<div class="container califica" ng-controller="calificaIndexCTL">
	<h1 class="green-title" ng-show="!tipo && byCCT">
		<strong>No has seleccionado escuelas para calificar</strong> 
		<br />
		Selecciona alguna de la lista
	</h1>
	<div mte-ng-search
		class="compare-table" 
		show-search='false' 
		params='byCCT' 
		click= 'click(event)'
		table-title='Escuelas visitadas'
		ng-show="!tipo && byCCT"
		>
	</div>
	<div ng-show="tipo && byCCT">
		<div mte-califica-preguntas tipo="tipo" cct="selectCCT" preloadpreguntas='<?=json_encode($this->preload_preguntas)?>'></div>
	</div>
</div>
