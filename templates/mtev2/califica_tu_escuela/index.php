<script type="text/ng-template" id="mteNgSearch.html">
	<?php $this->include_template('mteNgSearch','directives'); ?>
</script>
<script type="text/ng-template" id="mteTextSearch.html">
</script>
<div class="container califica" ng-controller="calificaIndexCTL">
	<h1 class="green-title">
		<strong>No has seleccionado escuelas para calificar</strong> 
		<br />
		Selecciona alguna de la lista
	</h1>
	<div mte-ng-search
		class="compare-table" 
		show-search='false' 
		params='byCCT' 
		click= 'click(event)'
		table-title='Escuelas visitadas'>
	</div>
</div>
