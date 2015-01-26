<form id="simple_search" layout="row" layout-sm="column">
	<div class="input-field" flex="66" flex-sm="100">
        <input type="text" 
        placeholder="Busca una escuela" 
        autocomplete="off"
        ng-model="text"
        typeahead="escuela.nombre for escuela in getSchool($viewValue) | filter:$viewValue"
        typeahead-template-url="typeahead-template.html"
        typeahead-on-select='onSelect($item)'
        />
		<button type="submit"><i class="icon-buscar-01"></i></button>
	</div>
	<a href="/compara" class="button-bordered" flex="30" flex-sm="100">Búsqueda avanzada</a>
	<script type="text/ng-template" id="typeahead-template.html">
	    <a tabindex="-1">
	    	<i class="icon-escuela-01"></i>
	        <strong><span bind-html-unsafe="match.model.nombre"></span> (<span bind-html-unsafe="match.model.nivel"></span>)</strong>
	    	<p><span bind-html-unsafe="match.model.direccion" class="small"></span></p>
	    </a>
	</script>
	<div class='clear'></div>
</form>
